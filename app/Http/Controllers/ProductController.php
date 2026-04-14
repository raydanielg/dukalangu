<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard.products.index');
    }

    public function create()
    {
        return view('dashboard.products.create');
    }

    public function inStock()
    {
        return view('dashboard.products.in-stock');
    }

    public function outOfStock()
    {
        return view('dashboard.products.out-of-stock');
    }
}
