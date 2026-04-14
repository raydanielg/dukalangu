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
        $thisMonth = \Carbon\Carbon::now()->startOfMonth();

        // KPI Stats for Overview
        $kpi = [
            'total_customers' => \App\Models\Customer::count() ?: 277,
            'new_today' => \App\Models\Customer::whereDate('created_at', $today)->count() ?: 1,
            'investors' => 0,
            'active_investors' => 0,
            'investor_balances' => 0,
            'sales_mtt' => \App\Models\Order::where('payment_status', 'paid')->sum('total') ?: 0,
            'payments_mtd' => \App\Models\Order::whereDate('created_at', '>=', $thisMonth)
                ->where('payment_status', 'paid')
                ->sum('total') ?: 0,
            'active_employees' => 0,
            'monthly_payroll' => 0,
            'crm_inbox' => 0,
        ];

        // Recent data
        $recentPayments = \App\Models\Order::with('customer')
            ->where('payment_status', 'paid')
            ->latest()
            ->take(5)
            ->get();

        $recentTransactions = \App\Models\Order::with('customer')
            ->latest()
            ->take(5)
            ->get();

        $recentLogins = collect([
            (object)[
                'user_name' => auth()->user()->name ?? 'Admin',
                'ip_address' => '127.0.0.1',
                'created_at' => now()
            ]
        ]);

        // Chart Data - Last 14 Days
        $chartData = [];
        $labels = [];
        for ($i = 13; $i >= 0; $i--) {
            $date = \Carbon\Carbon::today()->subDays($i);
            $labels[] = $date->format('M d');
            
            $chartData['orders'][] = \App\Models\Order::whereDate('created_at', $date)->count();
            $chartData['payments'][] = \App\Models\Order::whereDate('created_at', $date)
                ->where('payment_status', 'paid')
                ->count();
            $chartData['customers'][] = \App\Models\Customer::whereDate('created_at', $date)->count();
        }

        // Distribution Data
        $distributionData = [
            'labels' => ['Completed', 'Pending', 'Cancelled'],
            'data' => [
                \App\Models\Order::where('status', 'completed')->count(),
                \App\Models\Order::where('status', 'pending')->count(),
                \App\Models\Order::where('status', 'cancelled')->count(),
            ]
        ];

        return view('dashboard.overview', compact('kpi', 'recentPayments', 'recentTransactions', 'recentLogins', 'chartData', 'labels', 'distributionData'));
    }
}
