@extends('layouts.dashboard')

@section('title', 'All Products')
@section('page-title', 'Products')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="mb-1">All Products</h5>
        <p class="text-muted mb-0">Manage your store products</p>
    </div>
    <a href="{{ route('products.create') }}" class="btn btn-success">
        <i class="bi bi-plus-lg me-2"></i>Add Product
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">
                            <i class="bi bi-box fs-1 d-block mb-3 text-secondary"></i>
                            <h5>No Products Yet</h5>
                            <p>Start by adding your first product to the store.</p>
                            <a href="{{ route('products.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-lg me-2"></i>Add Your First Product
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
