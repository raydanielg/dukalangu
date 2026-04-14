<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::with(['store', 'category'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(20);
        
        $stats = [
            'total' => Product::where('user_id', auth()->id())->count(),
            'in_stock' => Product::where('user_id', auth()->id())->where('stock_quantity', '>', 0)->count(),
            'out_of_stock' => Product::where('user_id', auth()->id())->where('stock_quantity', '<=', 0)->count(),
            'low_stock' => Product::where('user_id', auth()->id())->whereColumn('stock_quantity', '<=', 'low_stock_threshold')->count(),
        ];
        
        return view('dashboard.products.index', compact('products', 'stats'));
    }

    public function create()
    {
        $stores = Store::where('user_id', auth()->id())->get();
        $categories = Category::where('user_id', auth()->id())->get();
        return view('dashboard.products.create', compact('stores', 'categories'));
    }

    public function inStock()
    {
        $products = Product::with(['store', 'category'])
            ->where('user_id', auth()->id())
            ->where('stock_quantity', '>', 0)
            ->latest()
            ->paginate(20);
        
        return view('dashboard.products.in-stock', compact('products'));
    }

    public function outOfStock()
    {
        $products = Product::with(['store', 'category'])
            ->where('user_id', auth()->id())
            ->where('stock_quantity', '<=', 0)
            ->latest()
            ->paginate(20);
        
        return view('dashboard.products.out-of-stock', compact('products'));
    }
}
