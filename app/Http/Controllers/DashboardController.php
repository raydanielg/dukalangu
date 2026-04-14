<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Customer;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $today = Carbon::today();
        $thisMonth = Carbon::now()->startOfMonth();

        // Simple Dashboard Stats
        $stats = [
            'total_sales_today' => Order::whereDate('created_at', $today)
                ->where('payment_status', 'paid')
                ->sum('total') ?? 0,
            'orders_today' => Order::whereDate('created_at', $today)->count(),
            'total_products' => Product::where('is_active', true)->count(),
            'products_in_stock' => Product::where('stock_quantity', '>', 0)->count(),
            'low_stock_products' => Product::whereColumn('stock_quantity', '<=', 'low_stock_threshold')->count(),
            'total_customers' => Customer::count(),
            'new_customers_this_month' => Customer::where('created_at', '>=', $thisMonth)->count(),
        ];

        // Recent orders
        $recentOrders = Order::with('customer')
            ->latest()
            ->take(5)
            ->get();

        // Low stock products
        $lowStockProducts = Product::whereColumn('stock_quantity', '<=', 'low_stock_threshold')
            ->where('stock_quantity', '>', 0)
            ->take(5)
            ->get();

        // Recent transactions data for dashboard
        $recentTransactions = Order::with('customer')
            ->latest()
            ->take(10)
            ->get();

        // Sales trend (last 7 days)
        $salesTrend = [];
        $trendLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $trendLabels[] = $date->format('D');
            $salesTrend[] = Order::whereDate('created_at', $date)
                ->where('payment_status', 'paid')
                ->sum('total');
        }

        // Top selling products
        $topProducts = Product::where('store_id', auth()->user()->store_id ?? 0)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard.index', compact('stats', 'recentOrders', 'lowStockProducts', 'recentTransactions', 'salesTrend', 'trendLabels', 'topProducts'));
    }
}
