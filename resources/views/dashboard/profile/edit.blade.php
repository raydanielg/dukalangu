@extends('layouts.dashboard')

@section('title', 'My Profile')
@section('page-title', 'My Profile')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="dashboard-card animate__animated animate__fadeIn">
            <div class="dashboard-card-header">
                <h5 class="dashboard-card-title">
                    <i data-lucide="user" class="me-2"></i>Profile Information
                </h5>
            </div>
            <div class="dashboard-card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        <i data-lucide="check-circle" class="me-2"></i>{{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Full Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                            value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Phone Number</label>
                        <div class="input-group">
                            <span class="input-group-text">🇹🇿 +255</span>
                            <input type="tel" name="phone" class="form-control" 
                                value="{{ old('phone', $user->phone) }}" placeholder="712345678">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Email Address</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                            value="{{ old('email', $user->email) }}" placeholder="optional@email.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i data-lucide="save" class="me-2"></i>Save Changes
                        </button>
                        <a href="{{ route('profile.store') }}" class="btn btn-outline-primary">
                            <i data-lucide="store" class="me-2"></i>Store Settings
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
