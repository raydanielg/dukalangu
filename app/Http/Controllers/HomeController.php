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

        $recentTransactions = collect([]); // Placeholder

        $recentLogins = collect([
            (object)[
                'user_name' => Auth::user()->name ?? 'Admin',
                'ip_address' => '127.0.0.1',
                'created_at' => now()
            ]
        ]);

        return view('dashboard.overview', compact('kpi', 'recentPayments', 'recentTransactions', 'recentLogins'));
    }
}
