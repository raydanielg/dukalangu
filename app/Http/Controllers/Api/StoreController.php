<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    /**
     * Get store overview
     */
    public function index(Request $request)
    {
        $user = $request->user();
        
        // Get products count
        $productsCount = Product::where('user_id', $user->id)->count();
        
        // Get total views (placeholder)
        $totalViews = 1234;
        
        // Get store URL
        $storeSlug = $user->store_slug ?? 'store-' . $user->id;
        $storeUrl = 'https://salamapay.co.tz/store/' . $storeSlug;
        
        return response()->json([
            'success' => true,
            'data' => [
                'store_name' => $user->business_name ?? $user->name . '\'s Store',
                'store_slug' => $storeSlug,
                'store_url' => $storeUrl,
                'products_count' => $productsCount,
                'total_views' => $totalViews,
                'is_active' => true,
                'qr_code' => 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . urlencode($storeUrl),
            ]
        ]);
    }

    /**
     * Get all products
     */
    public function getProducts(Request $request)
    {
        $user = $request->user();
        
        $products = Product::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'price' => $product->price,
                    'stock' => $product->stock,
                    'category' => $product->category,
                    'image_url' => $product->image_url,
                    'is_active' => $product->is_active,
                    'created_at' => $product->created_at->format('M d, Y'),
                ];
            });
        
        return response()->json([
            'success' => true,
            'data' => [
                'products' => $products,
                'total' => $products->count(),
            ]
        ]);
    }

    /**
     * Create new product
     */
    public function createProduct(Request $request)
    {
        $user = $request->user();
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|max:100',
            'image_url' => 'nullable|string|url',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        
        $product = Product::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category' => $request->category,
            'image_url' => $request->image_url,
            'is_active' => true,
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'data' => [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'stock' => $product->stock,
            ]
        ], 201);
    }

    /**
     * Update product
     */
    public function updateProduct(Request $request, $id)
    {
        $user = $request->user();
        
        $product = Product::where('id', $id)
            ->where('user_id', $user->id)
            ->first();
        
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }
        
        $product->update($request->only([
            'name', 'description', 'price', 'stock', 'category', 'image_url', 'is_active'
        ]));
        
        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully',
            'data' => $product
        ]);
    }

    /**
     * Delete product
     */
    public function deleteProduct(Request $request, $id)
    {
        $user = $request->user();
        
        $product = Product::where('id', $id)
            ->where('user_id', $user->id)
            ->first();
        
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }
        
        $product->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully'
        ]);
    }

    /**
     * Get single product
     */
    public function getProduct(Request $request, $id)
    {
        $user = $request->user();
        
        $product = Product::where('id', $id)
            ->where('user_id', $user->id)
            ->first();
        
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'stock' => $product->stock,
                'category' => $product->category,
                'image_url' => $product->image_url,
                'is_active' => $product->is_active,
                'created_at' => $product->created_at->format('M d, Y'),
            ]
        ]);
    }

    /**
     * Search products
     */
    public function searchProducts(Request $request)
    {
        $user = $request->user();
        $query = $request->get('q', '');
        
        $products = Product::where('user_id', $user->id)
            ->where(function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('category', 'like', "%{$query}%");
            })
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'stock' => $product->stock,
                    'category' => $product->category,
                    'image_url' => $product->image_url,
                    'is_active' => $product->is_active,
                ];
            });
        
        return response()->json([
            'success' => true,
            'data' => [
                'products' => $products,
                'total' => $products->count(),
            ]
        ]);
    }

    /**
     * Get categories
     */
    public function getCategories(Request $request)
    {
        $user = $request->user();
        
        $categories = Product::where('user_id', $user->id)
            ->select('category')
            ->distinct()
            ->pluck('category');
        
        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }

    /**
     * Get store analytics
     */
    public function getAnalytics(Request $request)
    {
        $user = $request->user();
        
        // Placeholder analytics data
        return response()->json([
            'success' => true,
            'data' => [
                'views_today' => 45,
                'views_week' => 320,
                'views_month' => 1234,
                'sales_today' => 5,
                'sales_week' => 32,
                'sales_month' => 156,
                'conversion_rate' => '3.2%',
                'top_products' => [
                    ['name' => 'iPhone 15 Pro', 'sales' => 12],
                    ['name' => 'AirPods Pro', 'sales' => 8],
                    ['name' => 'Samsung Galaxy', 'sales' => 5],
                ],
            ]
        ]);
    }

    /**
     * Update store settings
     */
    public function updateSettings(Request $request)
    {
        $user = $request->user();
        
        $validator = Validator::make($request->all(), [
            'business_name' => 'nullable|string|max:255',
            'store_slug' => 'nullable|string|max:50|unique:users,store_slug,' . $user->id,
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        
        $user->update($request->only([
            'business_name', 'store_slug', 'location', 'description'
        ]));
        
        return response()->json([
            'success' => true,
            'message' => 'Store settings updated successfully',
            'data' => [
                'business_name' => $user->business_name,
                'store_slug' => $user->store_slug,
            ]
        ]);
    }

    /**
     * Verify QR Code
     */
    public function verifyQR(Request $request)
    {
        $code = $request->get('code');
        
        // Placeholder QR verification
        return response()->json([
            'success' => true,
            'data' => [
                'valid' => true,
                'product_id' => 1,
                'product_name' => 'Sample Product',
                'price' => 50000,
            ]
        ]);
    }
}
