<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Dashboard Routes
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Product Routes (Coming Soon - placeholders)
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::get('/products/in-stock', [ProductController::class, 'inStock'])->name('products.in-stock');
Route::get('/products/out-of-stock', [ProductController::class, 'outOfStock'])->name('products.out-of-stock');

// POS Route (Coming Soon)
Route::get('/pos', function () {
    return view('dashboard.pos');
})->name('pos')->middleware('auth');

// Orders Route (Coming Soon)
Route::get('/orders', function () {
    return view('dashboard.orders');
})->name('orders')->middleware('auth');

// Social Authentication Routes
Route::get('auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);

Route::get('auth/facebook', [SocialAuthController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('auth/facebook/callback', [SocialAuthController::class, 'handleFacebookCallback']);

Route::get('auth/twitter', [SocialAuthController::class, 'redirectToTwitter'])->name('auth.twitter');
Route::get('auth/twitter/callback', [SocialAuthController::class, 'handleTwitterCallback']);
