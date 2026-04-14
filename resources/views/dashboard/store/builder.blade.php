@extends('layouts.dashboard')

@section('title', 'Create Your Store')
@section('page-title', 'Create Your Store')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="dashboard-card animate__animated animate__fadeIn">
            <div class="dashboard-card-header">
                <h5 class="dashboard-card-title">
                    <i data-lucide="store" class="me-2"></i>
                    {{ $store ? 'Update Your Store' : 'Create Your Online Store' }}
                </h5>
            </div>
            <div class="dashboard-card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i data-lucide="check-circle" class="me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('store.builder.save') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Store Name -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Store Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                            placeholder="e.g., Duka Langu" value="{{ old('name', $store->name ?? '') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Store Description <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                            rows="4" placeholder="Describe what you sell..." required>{{ old('description', $store->description ?? '') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Maximum 500 characters</div>
                    </div>

                    <!-- Contact Info -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Phone Number <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">🇹🇿 +255</span>
                                <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                                    placeholder="712345678" value="{{ old('phone', $store->phone ?? '') }}" required>
                            </div>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">WhatsApp Number</label>
                            <div class="input-group">
                                <span class="input-group-text">🇹🇿 +255</span>
                                <input type="tel" name="whatsapp" class="form-control @error('whatsapp') is-invalid @enderror" 
                                    placeholder="712345678" value="{{ old('whatsapp', $store->whatsapp ?? '') }}">
                            </div>
                            @error('whatsapp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Logo Upload -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Store Logo</label>
                        <div class="border rounded p-4 text-center bg-light">
                            @if($store && $store->logo)
                                <img src="{{ asset('storage/' . $store->logo) }}" alt="Current Logo" class="mb-3" style="max-height: 100px;">
                                <p class="text-muted small mb-2">Current logo</p>
                            @endif
                            <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" accept="image/*">
                            <div class="form-text mt-2">Recommended: 400x400px, Max 2MB (JPG, PNG)</div>
                        </div>
                        @error('logo')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Template Selection -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Choose Template <span class="text-danger">*</span></label>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="template-card">
                                    <input type="radio" name="template" value="modern" class="d-none" {{ old('template', $store->template ?? 'modern') == 'modern' ? 'checked' : '' }}>
                                    <div class="template-preview modern">
                                        <div class="template-name">Modern</div>
                                    </div>
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label class="template-card">
                                    <input type="radio" name="template" value="classic" class="d-none" {{ old('template', $store->template ?? '') == 'classic' ? 'checked' : '' }}>
                                    <div class="template-preview classic">
                                        <div class="template-name">Classic</div>
                                    </div>
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label class="template-card">
                                    <input type="radio" name="template" value="minimal" class="d-none" {{ old('template', $store->template ?? '') == 'minimal' ? 'checked' : '' }}>
                                    <div class="template-preview minimal">
                                        <div class="template-name">Minimal</div>
                                    </div>
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label class="template-card">
                                    <input type="radio" name="template" value="elegant" class="d-none" {{ old('template', $store->template ?? '') == 'elegant' ? 'checked' : '' }}>
                                    <div class="template-preview elegant">
                                        <div class="template-name">Elegant</div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        @error('template')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Store Link Preview -->
                    @if($store)
                    <div class="mb-4 p-3 bg-light rounded">
                        <label class="form-label fw-semibold">Your Store Link</label>
                        <div class="input-group">
                            <input type="text" class="form-control" value="{{ url('/store/' . $store->slug) }}" readonly>
                            <a href="{{ route('store.public', $store->slug) }}" target="_blank" class="btn btn-outline-primary">
                                <i data-lucide="external-link"></i> Visit
                            </a>
                        </div>
                        <div class="form-text">Share this link with your customers!</div>
                    </div>
                    @endif

                    <!-- Submit -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i data-lucide="save" class="me-2"></i>
                            {{ $store ? 'Update Store' : 'Create Store' }}
                        </button>
                        @if($store)
                        <a href="{{ route('store.public', $store->slug) }}" target="_blank" class="btn btn-success">
                            <i data-lucide="eye" class="me-2"></i>View Store
                        </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.template-card {
    cursor: pointer;
    display: block;
}

.template-card input:checked + .template-preview {
    border-color: #dc2626;
    box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
}

.template-preview {
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    transition: all 0.2s;
    height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.template-preview:hover {
    border-color: #d1d5db;
}

.template-name {
    font-weight: 600;
    color: #374151;
}

.template-preview.modern {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.template-preview.classic {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.template-preview.minimal {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.template-preview.elegant {
    background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
}

.template-preview.modern .template-name,
.template-preview.classic .template-name,
.template-preview.minimal .template-name,
.template-preview.elegant .template-name {
    color: white;
}
</style>
@endsection
