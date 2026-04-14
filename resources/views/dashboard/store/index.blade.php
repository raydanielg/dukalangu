@extends('layouts.dashboard')

@section('title', 'My Stores')
@section('page-title', 'My Stores')

@section('content')
<!-- Header Section with Prominent Add Button -->
<div class="dashboard-card mb-4 animate__animated animate__fadeIn">
    <div class="dashboard-card-body">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h3 class="mb-1">
                    <i data-lucide="store" class="me-2 text-primary"></i>My Stores
                </h3>
                <p class="text-muted mb-0">Manage your online stores and share them with customers</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="{{ route('store.builder') }}" class="btn btn-primary btn-lg">
                    <i data-lucide="plus-circle" class="me-2"></i>
                    <strong>Create New Store</strong>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Quick Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card-small bg-white p-3 rounded border">
            <div class="d-flex align-items-center">
                <div class="stat-icon-small bg-primary bg-opacity-10 text-primary rounded p-2 me-3">
                    <i data-lucide="store"></i>
                </div>
                <div>
                    <h5 class="mb-0">{{ $stores->count() }}</h5>
                    <small class="text-muted">Total Stores</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card-small bg-white p-3 rounded border">
            <div class="d-flex align-items-center">
                <div class="stat-icon-small bg-success bg-opacity-10 text-success rounded p-2 me-3">
                    <i data-lucide="package"></i>
                </div>
                <div>
                    <h5 class="mb-0">{{ $stores->sum(function($s) { return $s->products->count(); }) }}</h5>
                    <small class="text-muted">Total Products</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card-small bg-white p-3 rounded border">
            <div class="d-flex align-items-center">
                <div class="stat-icon-small bg-info bg-opacity-10 text-info rounded p-2 me-3">
                    <i data-lucide="shopping-bag"></i>
                </div>
                <div>
                    <h5 class="mb-0">{{ $stores->sum(function($s) { return $s->orders->count(); }) }}</h5>
                    <small class="text-muted">Total Orders</small>
                </div>
            </div>
        </div>
    </div>
</div>

@if($stores->count() > 0)
    <!-- Stores Table -->
    <div class="dashboard-card animate__animated animate__fadeIn">
        <div class="dashboard-card-header d-flex justify-content-between align-items-center">
            <h5 class="dashboard-card-title mb-0">
                <i data-lucide="list" class="me-2"></i>All Stores
            </h5>
            <span class="badge bg-secondary">{{ $stores->count() }} Total</span>
        </div>
        <div class="dashboard-card-body p-0">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 60px;">ID</th>
                        <th>Store Name</th>
                        <th>Contact</th>
                        <th style="width: 200px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stores as $store)
                    <tr>
                        <td>
                            <span class="fw-bold text-primary">#{{ $store->id }}</span>
                            @if($loop->first)
                                <br><span class="badge bg-primary mt-1" style="font-size: 10px;">Main</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($store->logo)
                                    <img src="{{ asset('storage/' . $store->logo) }}" alt="" class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                @else
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                        <i data-lucide="store" style="width: 20px; height: 20px; color: #9ca3af;"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="fw-semibold">{{ $store->name }}</div>
                                    <small class="text-muted">{{ Str::limit($store->description, 30) }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="small">
                                <div><i data-lucide="phone" style="width: 14px;" class="me-1"></i>+255 {{ $store->phone }}</div>
                                @if($store->whatsapp)
                                    <div class="text-success"><i data-lucide="message-circle" style="width: 14px;" class="me-1"></i>+255 {{ $store->whatsapp }}</div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('store.public', $store->slug) }}" target="_blank" class="btn btn-sm btn-success" title="View Store">
                                    <i data-lucide="eye" style="width: 16px;"></i>
                                </a>
                                <a href="{{ route('store.builder') }}" class="btn btn-sm btn-primary" title="Edit Store">
                                    <i data-lucide="edit" style="width: 16px;"></i>
                                </a>
                                <a href="{{ route('store.public', $store->slug) }}" target="_blank" class="btn btn-sm btn-info" title="Open in New Tab">
                                    <i data-lucide="external-link" style="width: 16px;"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" title="Delete Store" onclick="confirmDelete({{ $store->id }})">
                                    <i data-lucide="trash-2" style="width: 16px;"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete Form (Hidden) -->
    <form id="delete-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

@else
    <!-- Empty State with Nice SVG -->
    <div class="empty-state animate__animated animate__fadeIn">
        <div class="empty-icon">
            <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-danger">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                <line x1="12" y1="2" x2="12" y2="12" stroke-dasharray="4 4"></line>
                <circle cx="12" cy="7" r="2" fill="currentColor" stroke="none"></circle>
            </svg>
        </div>
        <h4 class="mt-3">No Stores Yet</h4>
        <p class="text-muted mb-4">Create your first online store to start selling!</p>
        <a href="{{ route('store.builder') }}" class="btn btn-primary btn-lg">
            <i data-lucide="plus-circle" class="me-2"></i>Create Your First Store
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
}

.data-table td {
    padding: 16px;
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

.store-description {
    color: #6b7280;
    font-size: 13px;
    margin-bottom: 12px;
    line-height: 1.5;
}

.store-meta {
    display: flex;
    gap: 8px;
    margin-bottom: 12px;
}

.store-template {
    font-size: 12px;
    color: #9ca3af;
    background: #f3f4f6;
    padding: 4px 10px;
    border-radius: 20px;
}

.store-stats {
    display: flex;
    gap: 16px;
    padding: 12px 0;
    border-top: 1px solid #f3f4f6;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: #6b7280;
}

.stat-item i {
    width: 16px;
    height: 16px;
}

.store-footer {
    padding-top: 12px;
    border-top: 1px solid #f3f4f6;
}

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

/* Empty State */
.empty-state {
    text-align: center;
    padding: 100px 40px;
    background: white;
    border-radius: 16px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.08);
}

.empty-state .btn {
    padding: 15px 40px;
    font-size: 18px;
    box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
}

.empty-icon {
    width: 100px;
    height: 100px;
    background: #fef2f2;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 24px;
}

.empty-icon i {
    width: 48px;
    height: 48px;
    color: #dc2626;
}

.empty-state h4 {
    font-size: 20px;
    font-weight: 600;
    color: #111827;
    margin-bottom: 8px;
}

.empty-state p {
    font-size: 15px;
    margin-bottom: 24px;
}
</style>
@endsection

@section('scripts')
<script>
function copyLink(inputId) {
    const input = document.getElementById(inputId);
    input.select();
    document.execCommand('copy');
    alert('Store link copied to clipboard!');
}

function confirmDelete(storeId) {
    if (confirm('Are you sure you want to delete this store? This action cannot be undone.')) {
        const form = document.getElementById('delete-form');
        form.action = '/store/' + storeId;
        form.submit();
    }
}
</script>
@endsection
