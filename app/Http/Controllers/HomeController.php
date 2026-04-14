<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $today = \Carbon\Carbon::today();

        $stats = [
            'total_sales_today' => \App\Models\Order::whereDate('created_at', $today)
                ->where('payment_status', 'paid')
                ->sum('total') ?? 0,
            'orders_today' => \App\Models\Order::whereDate('created_at', $today)->count(),
            'products_in_stock' => \App\Models\Product::where('stock_quantity', '>', 0)->count(),
            'total_customers' => \App\Models\Customer::count(),
            'low_stock_products' => \App\Models\Product::whereColumn('stock_quantity', '<=', 'low_stock_threshold')->count(),
        ];

        $recentOrders = \App\Models\Order::with('customer')
            ->latest()
            ->take(5)
            ->get();

        $lowStockProducts = \App\Models\Product::whereColumn('stock_quantity', '<=', 'low_stock_threshold')
            ->where('stock_quantity', '>', 0)
            ->take(5)
            ->get();

        return view('dashboard.index', compact('stats', 'recentOrders', 'lowStockProducts'));
    }
}
