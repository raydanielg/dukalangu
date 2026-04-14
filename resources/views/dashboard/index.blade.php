@extends('layouts.dashboard')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon green">
            <i class="bi bi-cash-stack"></i>
        </div>
        <div class="stat-content">
            <h3>TZS {{ number_format($stats['total_sales_today'], 0) }}</h3>
            <p>Total Sales Today</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue">
            <i class="bi bi-cart-check"></i>
        </div>
        <div class="stat-content">
            <h3>{{ $stats['orders_today'] }}</h3>
            <p>Orders Today</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon orange">
            <i class="bi bi-box-seam"></i>
        </div>
        <div class="stat-content">
            <h3>{{ $stats['products_in_stock'] }}</h3>
            <p>Products in Stock</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon purple">
            <i class="bi bi-people"></i>
        </div>
        <div class="stat-content">
            <h3>{{ $stats['total_customers'] }}</h3>
            <p>Total Customers</p>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Orders -->
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Recent Orders</h5>
                <a href="#" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Products</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                            <tr>
                                <td><span class="fw-semibold">#{{ $order->order_number }}</span></td>
                                <td>{{ $order->customer->name ?? 'Walk-in Customer' }}</td>
                                <td>{{ $order->items->count() }} items</td>
                                <td>TZS {{ number_format($order->total, 0) }}</td>
                                <td>
                                    <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'secondary') }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-5">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    <p class="mb-0">No orders yet. Start selling!</p>
                                    <a href="{{ route('pos') }}" class="btn btn-primary btn-sm mt-3">
                                        <i class="bi bi-cart-plus me-2"></i>Create First Order
                                    </a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Low Stock Alert -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>
                    Low Stock Products
                </h5>
            </div>
            <div class="card-body">
                @if($lowStockProducts->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($lowStockProducts as $product)
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <h6 class="mb-1">{{ $product->name }}</h6>
                                <small class="text-muted">{{ $product->stock_quantity }} {{ $product->unit }} remaining</small>
                            </div>
                            <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-warning">
                                Restock
                            </a>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-3">
                        <i class="bi bi-check-circle text-success fs-1 mb-2"></i>
                        <p class="text-muted mb-0">All products are well stocked!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('products.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle me-2"></i>Add New Product
                    </a>
                    <a href="{{ route('pos') }}" class="btn btn-primary">
                        <i class="bi bi-cart-plus me-2"></i>Open POS
                    </a>
                    <a href="{{ route('orders') }}" class="btn btn-outline-primary">
                        <i class="bi bi-receipt me-2"></i>View Orders
                    </a>
                </div>
            </div>
        </div>

        <!-- Store Info -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Store Info</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="text-muted small">Store Name</label>
                    <p class="mb-0 fw-semibold">{{ Auth::user()->name ?? 'My Store' }}</p>
                </div>
                <div class="mb-3">
                    <label class="text-muted small">Phone</label>
                    <p class="mb-0 fw-semibold">{{ Auth::user()->phone ?? 'Not set' }}</p>
                </div>
                <div class="mb-0">
                    <label class="text-muted small">Status</label>
                    <p class="mb-0"><span class="badge bg-success">Active</span></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
