@extends('layouts.dashboard')

@section('title', 'In Stock Products')
@section('page-title', 'In Stock')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="mb-1">Products In Stock</h5>
        <p class="text-muted mb-0">Products with available inventory</p>
    </div>
    <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
        <i class="bi bi-arrow-left me-2"></i>Back to All Products
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4" class="text-center text-muted py-5">
                            <i class="bi bi-check-circle fs-1 d-block mb-3 text-success"></i>
                            <h5>No Products In Stock</h5>
                            <p>Add products to see them here.</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
