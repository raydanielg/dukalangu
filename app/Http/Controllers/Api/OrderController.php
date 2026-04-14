<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Get all orders
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $status = $request->get('status');
        
        $query = Order::where('seller_id', $user->id)
            ->with('items');
        
        if ($status) {
            $query->where('status', $status);
        }
        
        $orders = $query->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($order) {
                return [
                    'id' => $order->id,
                    'order_number' => 'ORD-' . str_pad($order->id, 6, '0', STR_PAD_LEFT),
                    'customer_name' => $order->customer_name,
                    'customer_phone' => $order->customer_phone,
                    'total_amount' => $order->total_amount,
                    'status' => $order->status,
                    'payment_status' => $order->payment_status,
                    'items_count' => $order->items->count(),
                    'created_at' => $order->created_at->diffForHumans(),
                    'created_date' => $order->created_at->format('M d, Y'),
                ];
            });
        
        // Get stats
        $stats = [
            'total' => Order::where('seller_id', $user->id)->count(),
            'pending' => Order::where('seller_id', $user->id)->where('status', 'pending')->count(),
            'completed' => Order::where('seller_id', $user->id)->where('status', 'completed')->count(),
            'cancelled' => Order::where('seller_id', $user->id)->where('status', 'cancelled')->count(),
            'total_revenue' => Order::where('seller_id', $user->id)
                ->where('status', 'completed')
                ->sum('total_amount'),
        ];
        
        return response()->json([
            'success' => true,
            'data' => [
                'orders' => $orders,
                'stats' => $stats,
            ]
        ]);
    }

    /**
     * Get single order details
     */
    public function show(Request $request, $id)
    {
        $user = $request->user();
        
        $order = Order::where('id', $id)
            ->where('seller_id', $user->id)
            ->with('items.product')
            ->first();
        
        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $order->id,
                'order_number' => 'ORD-' . str_pad($order->id, 6, '0', STR_PAD_LEFT),
                'customer_name' => $order->customer_name,
                'customer_phone' => $order->customer_phone,
                'customer_email' => $order->customer_email,
                'delivery_address' => $order->delivery_address,
                'total_amount' => $order->total_amount,
                'shipping_cost' => $order->shipping_cost,
                'discount' => $order->discount,
                'status' => $order->status,
                'payment_status' => $order->payment_status,
                'payment_method' => $order->payment_method,
                'notes' => $order->notes,
                'created_at' => $order->created_at->format('M d, Y H:i'),
                'items' => $order->items->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'product_name' => $item->product_name,
                        'quantity' => $item->quantity,
                        'unit_price' => $item->unit_price,
                        'total_price' => $item->total_price,
                        'image_url' => $item->product?->image_url,
                    ];
                }),
            ]
        ]);
    }

    /**
     * Create new order (for POS)
     */
    public function create(Request $request)
    {
        $user = $request->user();
        
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|integer|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'payment_method' => 'required|string|in:cash,mobile_money,bank_transfer,card',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        
        // Calculate totals
        $totalAmount = 0;
        $items = [];
        
        foreach ($request->items as $item) {
            $product = \App\Models\Product::find($item['product_id']);
            if ($product && $product->stock >= $item['quantity']) {
                $itemTotal = $product->price * $item['quantity'];
                $totalAmount += $itemTotal;
                
                $items[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->price,
                    'total_price' => $itemTotal,
                ];
                
                // Reduce stock
                $product->decrement('stock', $item['quantity']);
            }
        }
        
        $order = Order::create([
            'seller_id' => $user->id,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_email' => $request->customer_email,
            'delivery_address' => $request->delivery_address,
            'total_amount' => $totalAmount,
            'status' => 'completed',
            'payment_status' => 'paid',
            'payment_method' => $request->payment_method,
            'notes' => $request->notes,
        ]);
        
        // Create order items
        foreach ($items as $item) {
            $item['order_id'] = $order->id;
            OrderItem::create($item);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Order created successfully',
            'data' => [
                'order_id' => $order->id,
                'order_number' => 'ORD-' . str_pad($order->id, 6, '0', STR_PAD_LEFT),
                'total_amount' => $totalAmount,
            ]
        ], 201);
    }

    /**
     * Update order status
     */
    public function updateStatus(Request $request, $id)
    {
        $user = $request->user();
        
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:pending,processing,shipped,completed,cancelled',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        
        $order = Order::where('id', $id)
            ->where('seller_id', $user->id)
            ->first();
        
        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }
        
        $order->update(['status' => $request->status]);
        
        return response()->json([
            'success' => true,
            'message' => 'Order status updated',
            'data' => [
                'id' => $order->id,
                'status' => $order->status,
            ]
        ]);
    }

    /**
     * Get order statistics
     */
    public function getStats(Request $request)
    {
        $user = $request->user();
        
        $today = now()->startOfDay();
        $week = now()->startOfWeek();
        $month = now()->startOfMonth();
        
        $stats = [
            'today' => [
                'orders' => Order::where('seller_id', $user->id)->whereDate('created_at', $today)->count(),
                'revenue' => Order::where('seller_id', $user->id)->whereDate('created_at', $today)->where('status', 'completed')->sum('total_amount'),
            ],
            'week' => [
                'orders' => Order::where('seller_id', $user->id)->where('created_at', '>=', $week)->count(),
                'revenue' => Order::where('seller_id', $user->id)->where('created_at', '>=', $week)->where('status', 'completed')->sum('total_amount'),
            ],
            'month' => [
                'orders' => Order::where('seller_id', $user->id)->where('created_at', '>=', $month)->count(),
                'revenue' => Order::where('seller_id', $user->id)->where('created_at', '>=', $month)->where('status', 'completed')->sum('total_amount'),
            ],
            'pending' => Order::where('seller_id', $user->id)->where('status', 'pending')->count(),
        ];
        
        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }

    /**
     * Cancel order
     */
    public function cancel(Request $request, $id)
    {
        $user = $request->user();
        
        $order = Order::where('id', $id)
            ->where('seller_id', $user->id)
            ->first();
        
        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }
        
        if ($order->status === 'completed') {
            return response()->json([
                'success' => false,
                'message' => 'Cannot cancel completed order'
            ], 400);
        }
        
        // Restore stock
        foreach ($order->items as $item) {
            if ($item->product) {
                $item->product->increment('stock', $item->quantity);
            }
        }
        
        $order->update(['status' => 'cancelled']);
        
        return response()->json([
            'success' => true,
            'message' => 'Order cancelled successfully'
        ]);
    }
}
