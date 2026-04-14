<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Product;

class StoreController extends Controller
{
    public function show($slug)
    {
        $store = Store::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $products = Product::where('store_id', $store->id)
            ->where('is_active', true)
            ->where('stock_quantity', '>', 0)
            ->get();

        return view('store.public', compact('store', 'products'));
    }
}
