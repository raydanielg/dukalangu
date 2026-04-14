<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Get dashboard overview data
     */
    public function index(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'success' => true,
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'phone' => $user->phone,
                    'email' => $user->email,
                    'avatar_url' => $user->avatar_url ?? null,
                    'business_name' => $user->business_name ?? null,
                    'location' => $user->location ?? null,
                    'created_at' => $user->created_at?->format('M Y'),
                ],
                'stats' => $this->getUserStats($user),
                'quick_actions' => [
                    ['icon' => 'store', 'label' => 'My Store', 'route' => '/store'],
                    ['icon' => 'products', 'label' => 'Products', 'route' => '/products'],
                    ['icon' => 'orders', 'label' => 'Orders', 'route' => '/orders'],
                    ['icon' => 'analytics', 'label' => 'Analytics', 'route' => '/analytics'],
                ],
                'notifications' => [
                    'count' => 3,
                    'unread' => [
                        ['id' => 1, 'title' => 'New order received', 'time' => '2 min ago'],
                        ['id' => 2, 'title' => 'Payment confirmed', 'time' => '1 hour ago'],
                        ['id' => 3, 'title' => 'Product review', 'time' => '3 hours ago'],
                    ]
                ]
            ]
        ]);
    }

    /**
     * Get user statistics
     */
    public function stats(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'success' => true,
            'data' => [
                'total_sales' => [
                    'value' => 2450000,
                    'currency' => 'TZS',
                    'change' => '+12%',
                    'period' => 'this month'
                ],
                'total_orders' => [
                    'value' => 156,
                    'change' => '+8%',
                    'period' => 'this month'
                ],
                'total_products' => [
                    'value' => 42,
                    'change' => '+3',
                    'period' => 'new this week'
                ],
                'total_customers' => [
                    'value' => 89,
                    'change' => '+15%',
                    'period' => 'this month'
                ],
                'chart_data' => [
                    'labels' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    'sales' => [45000, 52000, 48000, 61000, 55000, 72000, 68000],
                    'orders' => [8, 12, 10, 15, 11, 18, 14],
                ]
            ]
        ]);
    }

    /**
     * Get recent activity
     */
    public function recentActivity(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'success' => true,
            'data' => [
                'activities' => [
                    [
                        'id' => 1,
                        'type' => 'order',
                        'title' => 'New order #1234',
                        'description' => 'John Doe purchased 3 items',
                        'amount' => 125000,
                        'currency' => 'TZS',
                        'time' => '5 minutes ago',
                        'status' => 'pending'
                    ],
                    [
                        'id' => 2,
                        'type' => 'payment',
                        'title' => 'Payment received',
                        'description' => 'Order #1230 payment confirmed',
                        'amount' => 89000,
                        'currency' => 'TZS',
                        'time' => '1 hour ago',
                        'status' => 'completed'
                    ],
                    [
                        'id' => 3,
                        'type' => 'review',
                        'title' => 'New review',
                        'description' => 'Jane Smith rated your product 5 stars',
                        'time' => '3 hours ago',
                        'status' => 'positive'
                    ],
                    [
                        'id' => 4,
                        'type' => 'product',
                        'title' => 'Product added',
                        'description' => 'You added "Premium Sneakers" to your store',
                        'time' => '5 hours ago',
                        'status' => 'info'
                    ],
                ]
            ]
        ]);
    }

    /**
     * Get store link
     */
    public function getStoreLink(Request $request)
    {
        $user = $request->user();

        // Generate store URL based on user slug or ID
        $storeSlug = $user->store_slug ?? 'store-' . $user->id;
        $storeUrl = 'https://salamapay.co.tz/store/' . $storeSlug;

        return response()->json([
            'success' => true,
            'data' => [
                'store_url' => $storeUrl,
                'store_slug' => $storeSlug,
                'qr_code' => 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . urlencode($storeUrl),
                'share_text' => 'Visit my store on SalamaPay: ' . $storeUrl,
            ]
        ]);
    }

    /**
     * Get sales chart data
     */
    public function getSalesChart(Request $request)
    {
        $period = $request->get('period', 'week');
        $user = $request->user();

        // Generate sample chart data based on period
        $data = $this->generateChartData($period);

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * Get visitor statistics
     */
    public function getVisitors(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'success' => true,
            'data' => [
                'today_visitors' => 156,
                'week_visitors' => 1234,
                'month_visitors' => 5678,
                'total_visitors' => 45231,
                'online_now' => 12,
                'bounce_rate' => '35%',
            ]
        ]);
    }

    /**
     * Get all stats combined
     */
    public function getAllStats(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'success' => true,
            'data' => [
                'sales' => [
                    'today' => 145000,
                    'week' => 890000,
                    'month' => 2450000,
                    'change' => '+12%',
                ],
                'orders' => [
                    'today' => 8,
                    'week' => 56,
                    'month' => 156,
                    'pending' => 12,
                ],
                'products' => 42,
                'customers' => 89,
                'visitors' => [
                    'today' => 156,
                    'online' => 12,
                ],
                'chart' => $this->generateChartData('week'),
            ]
        ]);
    }

    /**
     * Generate chart data
     */
    private function generateChartData($period)
    {
        $labels = [];
        $sales = [];
        $visitors = [];

        if ($period === 'week') {
            $labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
            $sales = [45000, 52000, 48000, 61000, 55000, 72000, 68000];
            $visitors = [45, 52, 48, 61, 55, 72, 68];
        } elseif ($period === 'month') {
            $labels = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];
            $sales = [520000, 610000, 580000, 740000];
            $visitors = [520, 610, 580, 740];
        } else {
            $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
            $sales = [1800000, 2100000, 1950000, 2450000, 2200000, 2600000];
            $visitors = [1800, 2100, 1950, 2450, 2200, 2600];
        }

        return [
            'labels' => $labels,
            'sales' => $sales,
            'visitors' => $visitors,
            'period' => $period,
        ];
    }

    /**
     * Helper: Get user stats
     */
    private function getUserStats($user)
    {
        // Placeholder stats - replace with actual database queries
        return [
            'today_sales' => 145000,
            'week_sales' => 890000,
            'month_sales' => 2450000,
            'pending_orders' => 12,
            'total_products' => 42,
        ];
    }
}
