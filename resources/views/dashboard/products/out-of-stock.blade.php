@extends('layouts.dashboard')

@section('title', 'Out of Stock')
@section('page-title', 'Out of Stock')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="mb-1">Out of Stock Products</h5>
        <p class="text-muted mb-0 text-danger">
            <i class="bi bi-exclamation-triangle-fill me-1"></i>
            These products need to be restocked
        </p>
    </div>
    <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
        <i class="bi bi-arrow-left me-2"></i>Back to All Products
    </a>
</div>

<div class="card border-danger">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Last Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4" class="text-center text-muted py-5">
                            <i class="bi bi-emoji-smile fs-1 d-block mb-3 text-success"></i>
                            <h5>Great News!</h5>
                            <p>All your products are currently in stock.</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
