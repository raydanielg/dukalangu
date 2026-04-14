@extends('layouts.dashboard')

@section('title', 'Store Settings')
@section('page-title', 'Store Settings')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="dashboard-card animate__animated animate__fadeIn">
            <div class="dashboard-card-header">
                <h5 class="dashboard-card-title">
                    <i data-lucide="store" class="me-2"></i>Your Store
                </h5>
            </div>
            <div class="dashboard-card-body">
                @if($store)
                    <div class="text-center mb-4">
                        @if($store->logo)
                            <img src="{{ asset('storage/' . $store->logo) }}" alt="{{ $store->name }}" class="rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover;">
                        @endif
                        <h4>{{ $store->name }}</h4>
                        <p class="text-muted">{{ $store->description }}</p>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded">
                                <small class="text-muted">Phone</small>
                                <p class="mb-0 fw-semibold">+255 {{ $store->phone }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded">
                                <small class="text-muted">WhatsApp</small>
                                <p class="mb-0 fw-semibold">+255 {{ $store->whatsapp ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Your Store Link</label>
                        <div class="input-group">
                            <input type="text" class="form-control" value="{{ url('/store/' . $store->slug) }}" readonly id="storeLink">
                            <button class="btn btn-outline-secondary" type="button" onclick="copyLink()">
                                <i data-lucide="copy"></i> Copy
                            </button>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('store.builder') }}" class="btn btn-primary">
                            <i data-lucide="edit" class="me-2"></i>Edit Store
                        </a>
                        <a href="{{ route('store.public', $store->slug) }}" target="_blank" class="btn btn-success">
                            <i data-lucide="external-link" class="me-2"></i>View Store
                        </a>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i data-lucide="store" style="width: 64px; height: 64px; color: #9ca3af;"></i>
                        <h4 class="mt-3">No Store Yet</h4>
                        <p class="text-muted mb-4">Create your online store to start selling!</p>
                        <a href="{{ route('store.builder') }}" class="btn btn-primary">
                            <i data-lucide="plus" class="me-2"></i>Create Store
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function copyLink() {
    const link = document.getElementById('storeLink');
    link.select();
    document.execCommand('copy');
    alert('Link copied to clipboard!');
}
</script>
@endsection
