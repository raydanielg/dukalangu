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

// Store Builder Routes
Route::get('/store/builder', [App\Http\Controllers\StoreBuilderController::class, 'index'])->name('store.builder');
Route::post('/store/builder', [App\Http\Controllers\StoreBuilderController::class, 'store'])->name('store.builder.save');
Route::get('/store/{slug}', [App\Http\Controllers\StoreController::class, 'show'])->name('store.public');

// Product Routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/in-stock', [ProductController::class, 'inStock'])->name('products.in-stock');
Route::get('/products/out-of-stock', [ProductController::class, 'outOfStock'])->name('products.out-of-stock');

// Category Routes
Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
Route::post('/categories', [App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');

// Profile Routes
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile/store', [App\Http\Controllers\ProfileController::class, 'storeSettings'])->name('profile.store');

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
