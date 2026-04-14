@extends('layouts.dashboard')

@section('title', 'My Profile')
@section('page-title', 'My Profile')

@section('content')
<!-- Profile Header Card -->
<div class="dashboard-card mb-4 animate__animated animate__fadeIn">
    <div class="dashboard-card-body">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h3 class="mb-1">
                    <i data-lucide="user-circle" class="me-2 text-primary"></i>My Profile
                </h3>
                <p class="text-muted mb-0">Manage your personal information and preferences</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="{{ route('profile.store') }}" class="btn btn-outline-primary">
                    <i data-lucide="store" class="me-2"></i>Store Settings
                </a>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i data-lucide="check-circle" class="me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row">
    <!-- Left Column - Profile Picture & Basic Info -->
    <div class="col-lg-4 mb-4">
        <!-- Avatar Card -->
        <div class="dashboard-card animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
            <div class="dashboard-card-header">
                <h5 class="dashboard-card-title">Profile Picture</h5>
            </div>
            <div class="dashboard-card-body text-center">
                <div class="avatar-preview mb-3">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="avatar-img">
                    @else
                        <div class="avatar-placeholder">
                            <span>{{ substr($user->name, 0, 1) }}</span>
                        </div>
                    @endif
                </div>
                <div class="text-center mb-3">
                    <h5 class="mb-1">{{ $user->name }}</h5>
                    <p class="text-muted mb-0 small">{{ $user->phone ? '+255 ' . $user->phone : 'No phone added' }}</p>
                </div>
                <!-- Email Verification Badge -->
                @if($user->email)
                    @if($user->email_verified_at)
                        <span class="badge bg-success mb-2"><i data-lucide="check-circle" class="me-1" style="width: 12px;"></i>Email Verified</span>
                    @else
                        <span class="badge bg-warning text-dark mb-2"><i data-lucide="alert-circle" class="me-1" style="width: 12px;"></i>Email Not Verified</span>
                    @endif
                @else
                    <span class="badge bg-secondary mb-2"><i data-lucide="mail-x" class="me-1" style="width: 12px;"></i>No Email Added</span>
                @endif
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="dashboard-card mt-4 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
            <div class="dashboard-card-header">
                <h5 class="dashboard-card-title">Account Stats</h5>
            </div>
            <div class="dashboard-card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Member Since</span>
                    <span class="fw-semibold">{{ $user->created_at->format('M Y') }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Stores</span>
                    <span class="fw-semibold">{{ $user->stores->count() ?? 0 }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Products</span>
                    <span class="fw-semibold">{{ $user->products->count() ?? 0 }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column - Edit Form -->
    <div class="col-lg-8">
        <div class="dashboard-card animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
            <div class="dashboard-card-header">
                <h5 class="dashboard-card-title">
                    <i data-lucide="edit-3" class="me-2"></i>Edit Profile
                </h5>
            </div>
            <div class="dashboard-card-body">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Profile Picture Upload -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Change Profile Picture</label>
                        <div class="border rounded p-3 bg-light">
                            <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror" accept="image/*">
                            <div class="form-text">Recommended: 400x400px, Max 2MB</div>
                            @error('avatar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Full Name -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                            value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Bio / About -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">About / Bio</label>
                        <textarea name="bio" class="form-control @error('bio') is-invalid @enderror" 
                            rows="3" placeholder="Tell us about yourself...">{{ old('bio', $user->bio) }}</textarea>
                        <div class="form-text">Brief description about yourself (max 500 characters)</div>
                        @error('bio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Phone Numbers Section -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Phone Numbers</label>
                        
                        <!-- Primary Phone (Required) -->
                        <div class="input-group mb-2">
                            <span class="input-group-text bg-primary text-white">Primary</span>
                            <span class="input-group-text">🇹🇿 +255</span>
                            <input type="tel" name="phone" class="form-control" 
                                value="{{ old('phone', $user->phone) }}" placeholder="Your main number (required)" required>
                        </div>
                        <div class="form-text mb-2">This is your primary contact number (required)</div>

                        <!-- Secondary Phone 1 -->
                        <div class="input-group mb-2">
                            <span class="input-group-text">Alt 1</span>
                            <span class="input-group-text">🇹🇿 +255</span>
                            <input type="tel" name="phone_alt_1" class="form-control" 
                                value="{{ old('phone_alt_1', $user->phone_alt_1) }}" placeholder="Alternative number 1">
                        </div>

                        <!-- Secondary Phone 2 -->
                        <div class="input-group">
                            <span class="input-group-text">Alt 2</span>
                            <span class="input-group-text">🇹🇿 +255</span>
                            <input type="tel" name="phone_alt_2" class="form-control" 
                                value="{{ old('phone_alt_2', $user->phone_alt_2) }}" placeholder="Alternative number 2">
                        </div>
                        <div class="form-text">Add extra phone numbers for better reachability</div>
                    </div>

                    <!-- Email Address -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Email Address</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                            value="{{ old('email', $user->email) }}" placeholder="your@email.com">
                        @if(!$user->email)
                            <div class="form-text text-warning">
                                <i data-lucide="alert-triangle" class="me-1" style="width: 14px;"></i>
                                No email added. We recommend adding an email for account recovery.
                            </div>
                        @elseif(!$user->email_verified_at)
                            <div class="form-text text-warning">
                                <i data-lucide="alert-circle" class="me-1" style="width: 14px;"></i>
                                Email not verified. Please check your inbox for verification link.
                            </div>
                        @else
                            <div class="form-text text-success">
                                <i data-lucide="check-circle" class="me-1" style="width: 14px;"></i>
                                Email verified successfully.
                            </div>
                        @endif
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i data-lucide="save" class="me-2"></i>Save All Changes
                        </button>
                        <a href="{{ route('profile.store') }}" class="btn btn-outline-primary">
                            <i data-lucide="settings" class="me-2"></i>Store Settings
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.avatar-preview {
    display: flex;
    justify-content: center;
}

.avatar-img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #f3f4f6;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.avatar-placeholder {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: linear-gradient(135deg, #16a34a, #15803d);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 48px;
    color: white;
    font-weight: 700;
    border: 4px solid #f3f4f6;
    box-shadow: 0 4px 12px rgba(22, 163, 74, 0.3);
}
</style>
@endsection
