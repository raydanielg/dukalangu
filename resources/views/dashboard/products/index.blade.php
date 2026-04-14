@extends('layouts.dashboard')

@section('title', 'All Products')
@section('page-title', 'Products')

@section('content')
<!-- Header Section with Prominent Add Button -->
<div class="dashboard-card mb-4 animate__animated animate__fadeIn">
    <div class="dashboard-card-body">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h3 class="mb-1">
                    <i data-lucide="package" class="me-2 text-primary"></i>Products
                </h3>
                <p class="text-muted mb-0">Manage all your products with barcode support</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="{{ route('products.create') }}" class="btn btn-primary btn-lg">
                    <i data-lucide="plus-circle" class="me-2"></i>
                    <strong>Add Product</strong>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Quick Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="stat-card-small bg-white p-3 rounded border animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
            <div class="d-flex align-items-center">
                <div class="stat-icon-small bg-primary bg-opacity-10 text-primary rounded p-2 me-3">
                    <i data-lucide="package"></i>
                </div>
                <div>
                    <h5 class="mb-0">{{ $stats['total'] ?? 0 }}</h5>
                    <small class="text-muted">Total Products</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card-small bg-white p-3 rounded border animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
            <div class="d-flex align-items-center">
                <div class="stat-icon-small bg-success bg-opacity-10 text-success rounded p-2 me-3">
                    <i data-lucide="check-circle"></i>
                </div>
                <div>
                    <h5 class="mb-0">{{ $stats['in_stock'] ?? 0 }}</h5>
                    <small class="text-muted">In Stock</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card-small bg-white p-3 rounded border animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
            <div class="d-flex align-items-center">
                <div class="stat-icon-small bg-danger bg-opacity-10 text-danger rounded p-2 me-3">
                    <i data-lucide="x-circle"></i>
                </div>
                <div>
                    <h5 class="mb-0">{{ $stats['out_of_stock'] ?? 0 }}</h5>
                    <small class="text-muted">Out of Stock</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card-small bg-white p-3 rounded border animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
            <div class="d-flex align-items-center">
                <div class="stat-icon-small bg-warning bg-opacity-10 text-warning rounded p-2 me-3">
                    <i data-lucide="alert-triangle"></i>
                </div>
                <div>
                    <h5 class="mb-0">{{ $stats['low_stock'] ?? 0 }}</h5>
                    <small class="text-muted">Low Stock</small>
                </div>
            </div>
        </div>
    </div>
</div>

@if($products->count() > 0)
    <!-- Products Table -->
    <div class="dashboard-card animate__animated animate__fadeIn">
        <div class="dashboard-card-header d-flex justify-content-between align-items-center">
            <h5 class="dashboard-card-title mb-0">
                <i data-lucide="list" class="me-2"></i>All Products
            </h5>
            <span class="badge bg-secondary">{{ $products->total() }} Total</span>
        </div>
        <div class="dashboard-card-body p-0">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 50px;">ID</th>
                            <th>Product</th>
                            <th style="width: 150px;">Barcode</th>
                            <th>Category</th>
                            <th style="width: 120px;">Price</th>
                            <th style="width: 100px;">Stock</th>
                            <th style="width: 100px;">Status</th>
                            <th style="width: 180px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>
                                <span class="fw-bold text-primary">#{{ $product->id }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="" class="rounded me-2" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="rounded bg-light d-flex align-items-center justify-content-center me-2" style="width: 50px; height: 50px;">
                                            <i data-lucide="package" style="width: 24px; height: 24px; color: #9ca3af;"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="fw-semibold">{{ $product->name }}</div>
                                        <small class="text-muted">{{ $product->store->name ?? 'No Store' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($product->barcode)
                                    <span class="font-monospace text-secondary small">{{ $product->barcode }}</span>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>
                            <td>
                                @if($product->category)
                                    <span class="badge bg-info">{{ $product->category->name }}</span>
                                @else
                                    <span class="text-muted small">Uncategorized</span>
                                @endif
                            </td>
                            <td>
                                <span class="fw-bold">TSh {{ number_format($product->price, 0) }}</span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $product->stock_quantity > 0 ? 'success' : 'danger' }}">
                                    {{ $product->stock_quantity }} {{ $product->unit }}
                                </span>
                            </td>
                            <td>
                                @if($product->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary" title="Edit Product">
                                        <i data-lucide="edit" style="width: 16px;"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-success" title="Duplicate" onclick="duplicateProduct({{ $product->id }})">
                                        <i data-lucide="copy" style="width: 16px;"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-info" title="View" onclick="viewProduct({{ $product->id }})">
                                        <i data-lucide="eye" style="width: 16px;"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" title="Delete" onclick="confirmDelete({{ $product->id }})">
                                        <i data-lucide="trash-2" style="width: 16px;"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($products->hasPages())
            <div class="d-flex justify-content-end p-3 border-top">
                {{ $products->links() }}
            </div>
            @endif
        </div>
    </div>

    <!-- Delete Form (Hidden) -->
    <form id="delete-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

@else
    <!-- Empty State -->
    <div class="empty-state animate__animated animate__fadeIn">
        <div class="empty-icon">
            <div class="empty-icon-circle">
                <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                    <line x1="8" y1="21" x2="16" y2="21"></line>
                    <line x1="12" y1="17" x2="12" y2="21"></line>
                    <path d="M12 7 L12 7" stroke-width="3" stroke-linecap="round"></path>
                    <path d="M12 11 L12 11" stroke-width="3" stroke-linecap="round"></path>
                    <path d="M8 7 L8 7" stroke-width="3" stroke-linecap="round"></path>
                    <path d="M8 11 L8 11" stroke-width="3" stroke-linecap="round"></path>
                    <path d="M16 7 L16 7" stroke-width="3" stroke-linecap="round"></path>
                    <path d="M16 11 L16 11" stroke-width="3" stroke-linecap="round"></path>
                </svg>
            </div>
        </div>
        <h4 class="mt-3 fw-bold text-success">No Products Yet</h4>
        <p class="text-muted mb-4">Start adding products to your store inventory!</p>
        <a href="{{ route('products.create') }}" class="btn btn-primary btn-lg">
            <i data-lucide="plus-circle" class="me-2"></i>Add Your First Product
        </a>
    </div>
@endif
@endsection

@section('styles')
<style>
/* Stat Cards */
.stat-card-small {
    transition: all 0.2s;
}
.stat-card-small:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
.stat-icon-small {
    display: flex;
    align-items: center;
    justify-content: center;
}
.stat-icon-small i {
    width: 24px;
    height: 24px;
}

/* Table Styles */
.data-table th {
    background: #f8fafc;
    font-weight: 600;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 12px 16px;
    border-bottom: 2px solid #e2e8f0;
    white-space: nowrap;
}
.data-table td {
    padding: 12px 16px;
    vertical-align: middle;
    border-bottom: 1px solid #f1f5f9;
}
.data-table tr:hover td {
    background: #f8fafc;
}
.data-table .btn-sm {
    padding: 6px 10px;
}
.data-table .btn-sm i {
    width: 14px;
    height: 14px;
}
.font-monospace {
    font-family: 'Courier New', monospace;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 60px 20px;
    background: white;
    border-radius: 16px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.08);
}
.empty-icon-circle {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: linear-gradient(135deg, #22c55e, #16a34a);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    box-shadow: 0 8px 25px rgba(34, 197, 94, 0.3);
}
.empty-icon-circle svg {
    color: white;
}
</style>
@endsection

@section('scripts')
<script>
function confirmDelete(productId) {
    if (confirm('Are you sure you want to delete this product?')) {
        document.getElementById('delete-form').action = '/dashboard/products/' + productId;
        document.getElementById('delete-form').submit();
    }
}

function duplicateProduct(productId) {
    if (confirm('Duplicate this product?')) {
        // Implement duplicate logic
        alert('Duplicate feature coming soon!');
    }
}

function viewProduct(productId) {
    // Implement view logic - could open a modal or redirect
    alert('View product: ' + productId);
}
</script>
@endsection
