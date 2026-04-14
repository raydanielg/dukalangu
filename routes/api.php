<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\StoreController;
use App\Http\Controllers\Api\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes (require authentication)
Route::middleware('auth:sanctum')->group(function () {
    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::put('/profile', [AuthController::class, 'updateProfile']);
    Route::post('/change-password', [AuthController::class, 'changePassword']);

    // Dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/dashboard/stats', [DashboardController::class, 'stats']);
    Route::get('/dashboard/recent-activity', [DashboardController::class, 'recentActivity']);
    Route::get('/dashboard/chart', [DashboardController::class, 'getSalesChart']);
    Route::get('/dashboard/visitors', [DashboardController::class, 'getVisitors']);
    Route::get('/dashboard/all-stats', [DashboardController::class, 'getAllStats']);

    // Store routes
    Route::get('/store/link', [DashboardController::class, 'getStoreLink']);
    Route::get('/store', [StoreController::class, 'index']);
    Route::get('/store/products', [StoreController::class, 'getProducts']);
    Route::get('/store/products/{id}', [StoreController::class, 'getProduct']);
    Route::get('/store/products/search', [StoreController::class, 'searchProducts']);
    Route::post('/store/products', [StoreController::class, 'createProduct']);
    Route::put('/store/products/{id}', [StoreController::class, 'updateProduct']);
    Route::delete('/store/products/{id}', [StoreController::class, 'deleteProduct']);
    Route::get('/store/categories', [StoreController::class, 'getCategories']);
    Route::get('/store/analytics', [StoreController::class, 'getAnalytics']);
    Route::put('/store/settings', [StoreController::class, 'updateSettings']);
    Route::post('/store/verify-qr', [StoreController::class, 'verifyQR']);

    // Order routes
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/stats', [OrderController::class, 'getStats']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    Route::post('/orders', [OrderController::class, 'create']);
    Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus']);
    Route::post('/orders/{id}/cancel', [OrderController::class, 'cancel']);
    Route::get('/orders/stats', [OrderController::class, 'getStats']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    Route::post('/orders', [OrderController::class, 'create']);
    Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus']);
    Route::post('/orders/{id}/cancel', [OrderController::class, 'cancel']);
});

// Health check
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'message' => 'API is running',
        'timestamp' => now()->toIso8601String()
    ]);
});
