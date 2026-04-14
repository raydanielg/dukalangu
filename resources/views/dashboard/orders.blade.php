@extends('layouts.dashboard')

@section('title', 'Orders')
@section('page-title', 'Orders')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="mb-1">All Orders</h5>
        <p class="text-muted mb-0">View and manage customer orders</p>
    </div>
    <a href="{{ route('pos') }}" class="btn btn-success">
        <i class="bi bi-plus-lg me-2"></i>New Order
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="bi bi-receipt fs-1 d-block mb-3 text-secondary"></i>
                            <h5>No Orders Yet</h5>
                            <p>Orders will appear here once customers make purchases.</p>
                            <a href="{{ route('pos') }}" class="btn btn-primary">
                                <i class="bi bi-cart-plus me-2"></i>Create First Order
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
