@extends('layouts.dashboard')

@section('title', 'My Stores')
@section('page-title', 'My Stores')

@section('content')
<!-- Header Section -->
<div class="d-flex justify-content-between align-items-center mb-4 animate__animated animate__fadeIn">
    <div>
        <h4 class="mb-1">Your Online Stores</h4>
        <p class="text-muted mb-0">Manage and preview your stores</p>
    </div>
    <a href="{{ route('store.builder') }}" class="btn btn-primary">
        <i data-lucide="plus-circle" class="me-2"></i>Add New Store
    </a>
</div>

@if($stores->count() > 0)
    <!-- Stores Grid -->
    <div class="row g-4">
        @foreach($stores as $store)
        <div class="col-lg-4 col-md-6 animate__animated animate__fadeInUp" style="animation-delay: {{ $loop->iteration * 0.1 }}s;">
            <div class="store-card">
                <!-- Store Preview -->
                <div class="store-preview">
                    @if($store->logo)
                        <img src="{{ asset('storage/' . $store->logo) }}" alt="{{ $store->name }}" class="store-logo">
                    @else
                        <div class="store-logo-placeholder">
                            <i data-lucide="store"></i>
                        </div>
                    @endif
                    <div class="store-overlay">
                        <div class="store-actions">
                            <a href="{{ route('store.public', $store->slug) }}" target="_blank" class="action-btn view" title="View Store">
                                <i data-lucide="eye"></i>
                            </a>
                            <a href="{{ route('store.builder') }}" class="action-btn edit" title="Edit Store">
                                <i data-lucide="edit-2"></i>
                            </a>
                            <button type="button" class="action-btn delete" title="Delete Store" onclick="confirmDelete({{ $store->id }})">
                                <i data-lucide="trash-2"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Store Info -->
                <div class="store-info">
                    <h5 class="store-name">{{ $store->name }}</h5>
                    <p class="store-description">{{ Str::limit($store->description, 60) }}</p>
                    
                    <div class="store-meta">
                        <span class="badge bg-{{ $store->is_active ? 'success' : 'secondary' }}">
                            {{ $store->is_active ? 'Active' : 'Inactive' }}
                        </span>
                        <span class="store-template">{{ ucfirst($store->template) }}</span>
                    </div>

                    <div class="store-link mt-3">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" value="{{ url('/store/' . $store->slug) }}" readonly id="link-{{ $store->id }}">
                            <button class="btn btn-outline-secondary" type="button" onclick="copyLink('link-{{ $store->id }}')">
                                <i data-lucide="copy" style="width: 16px;"></i>
                            </button>
                        </div>
                    </div>

                    <div class="store-stats mt-3">
                        <div class="stat-item">
                            <i data-lucide="package"></i>
                            <span>{{ $store->products->count() }} Products</span>
                        </div>
                        <div class="stat-item">
                            <i data-lucide="shopping-bag"></i>
                            <span>{{ $store->orders->count() }} Orders</span>
                        </div>
                    </div>

                    <div class="store-footer mt-3">
                        <a href="{{ route('store.public', $store->slug) }}" target="_blank" class="btn btn-primary w-100">
                            <i data-lucide="external-link" class="me-2"></i>View Online Store
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
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
            <i data-lucide="store"></i>
        </div>
        <h4>No Stores Yet</h4>
        <p class="text-muted">Create your first online store to start selling!</p>
        <a href="{{ route('store.builder') }}" class="btn btn-primary btn-lg">
            <i data-lucide="plus-circle" class="me-2"></i>Create Your First Store
        </a>
    </div>
@endif
@endsection

@section('styles')
<style>
.store-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    border: 1px solid #f3f4f6;
}

.store-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
}

.store-preview {
    position: relative;
    height: 200px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.store-preview::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.1);
}

.store-logo {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid white;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    position: relative;
    z-index: 1;
}

.store-logo-placeholder {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    position: relative;
    z-index: 1;
}

.store-logo-placeholder i {
    width: 40px;
    height: 40px;
    color: #667eea;
}

.store-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s;
}

.store-card:hover .store-overlay {
    opacity: 1;
}

.store-actions {
    display: flex;
    gap: 12px;
}

.action-btn {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
}

.action-btn i {
    width: 20px;
    height: 20px;
}

.action-btn.view {
    background: white;
    color: #111827;
}

.action-btn.view:hover {
    background: #f3f4f6;
    transform: scale(1.1);
}

.action-btn.edit {
    background: #3b82f6;
    color: white;
}

.action-btn.edit:hover {
    background: #2563eb;
    transform: scale(1.1);
}

.action-btn.delete {
    background: #ef4444;
    color: white;
}

.action-btn.delete:hover {
    background: #dc2626;
    transform: scale(1.1);
}

.store-info {
    padding: 20px;
}

.store-name {
    font-size: 18px;
    font-weight: 600;
    color: #111827;
    margin-bottom: 8px;
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

/* Empty State */
.empty-state {
    text-align: center;
    padding: 80px 20px;
    background: white;
    border-radius: 16px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.08);
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
