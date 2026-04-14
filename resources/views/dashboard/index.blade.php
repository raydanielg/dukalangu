@extends('layouts.dashboard')

@section('title', 'Dashboard')
@section('page-title', 'Overview')

@section('content')
<!-- Welcome Banner -->
<div class="welcome-banner">
    <h2>Hello, {{ Auth::user()->name ?? 'There' }}. Welcome to {{ config('app.name') }}.</h2>
    <p>To keep your account secure and enable sales, we need to verify a few things. This helps protect your funds and unlocks the full {{ config('app.name') }} experience.</p>
</div>

<!-- Stats Row -->
<div class="stats-row">
    <div class="stat-box">
        <div class="stat-box-header">
            <span class="stat-box-title">Available Balance</span>
            <i class="bi bi-wallet2 stat-box-icon"></i>
        </div>
        <div class="stat-box-value">TSh {{ number_format($stats['total_sales_today'], 0) }}</div>
        <div class="stat-box-subtitle">Ready for withdrawal</div>
    </div>
    <div class="stat-box">
        <div class="stat-box-header">
            <span class="stat-box-title">Total Balance</span>
            <i class="bi bi-cash-stack stat-box-icon"></i>
        </div>
        <div class="stat-box-value">TSh {{ number_format($stats['total_sales_today'] * 1.2, 0) }}</div>
        <div class="stat-box-subtitle">Including pending</div>
    </div>
    <div class="stat-box">
        <div class="stat-box-header">
            <span class="stat-box-title">Payments This Week</span>
            <i class="bi bi-graph-up stat-box-icon"></i>
        </div>
        <div class="stat-box-value">TSh {{ number_format($stats['total_sales_today'] * 7, 0) }}</div>
        <div class="stat-box-subtitle">+12.5% vs last week</div>
    </div>
    <div class="stat-box">
        <div class="stat-box-header">
            <span class="stat-box-title">Transactions</span>
            <i class="bi bi-receipt stat-box-icon"></i>
        </div>
        <div class="stat-box-value">{{ $stats['orders_today'] }}</div>
    </div>
</div>

<!-- Action Cards -->
<div class="action-cards">
    <div class="action-card" onclick="window.location='{{ route('pos') }}'">
        <div class="action-card-icon">
            <i class="bi bi-credit-card"></i>
        </div>
        <div class="action-card-content">
            <h4>Quick Sale <span class="action-card-badge">NEW</span></h4>
            <p>Process sales and accept payments from customers</p>
        </div>
    </div>
    <div class="action-card" onclick="window.location='{{ route('products.create') }}'">
        <div class="action-card-icon">
            <i class="bi bi-box-seam"></i>
        </div>
        <div class="action-card-content">
            <h4>Add Product</h4>
            <p>Create products and add to your inventory</p>
        </div>
    </div>
    <div class="action-card" onclick="window.location='{{ route('orders') }}'">
        <div class="action-card-icon">
            <i class="bi bi-truck"></i>
        </div>
        <div class="action-card-content">
            <h4>View Orders</h4>
            <p>Track and manage customer orders</p>
        </div>
    </div>
</div>

<!-- Recent Orders Table -->
<div class="content-card">
    <div class="content-card-header">
        <h3 class="content-card-title">Recent Orders</h3>
        <a href="{{ route('orders') }}" class="btn btn-sm btn-outline-primary">View all</a>
    </div>
    <div class="content-card-body p-0">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Reference</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                <tr>
                    <td><span class="fw-semibold text-primary">{{ $order->order_number }}</span></td>
                    <td>{{ $order->customer->name ?? 'Walk-in Customer' }}</td>
                    <td>{{ $order->customer->phone ?? '-' }}</td>
                    <td class="fw-semibold">TSh {{ number_format($order->total, 0) }}</td>
                    <td>
                        <span class="badge badge-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'secondary') }}">
                            {{ strtoupper($order->status) }}
                        </span>
                    </td>
                    <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-5">
                        <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                        <p class="mb-3">No orders yet. Start selling!</p>
                        <a href="{{ route('pos') }}" class="btn btn-primary">
                            <i class="bi bi-cart-plus me-2"></i>Create First Order
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
