@extends('layouts.auth')

@section('title', 'Create Account')
@section('meta_description', 'Create your Dukalangu account today. Join Tanzania\'s premier job portal and unlock thousands of career opportunities.')
@section('meta_keywords', 'register Dukalangu, create account, sign up, join job portal Tanzania')

@section('content')
<div class="auth-container">
    <div class="auth-wrapper">
        <!-- Left Side - Branding -->
        <div class="auth-branding">
            <div class="branding-content">
                <div class="logo-section">
                    <div class="logo-circle">
                        <svg viewBox="0 0 120 120" class="dukalangu-logo">
                            <circle cx="60" cy="60" r="55" fill="none" stroke="currentColor" stroke-width="3"/>
                            <circle cx="60" cy="60" r="45" fill="none" stroke="currentColor" stroke-width="1.5" stroke-dasharray="4 4"/>
                            <text x="60" y="45" text-anchor="middle" font-size="28" font-weight="800" fill="currentColor">D</text>
                            <path d="M60 52 L60 75" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                            <circle cx="60" cy="78" r="5" fill="currentColor"/>
                            <text x="60" y="95" text-anchor="middle" font-size="7" font-weight="600" fill="currentColor" letter-spacing="2">DUKALANGU</text>
                        </svg>
                    </div>
                </div>
                <h1 class="portal-title">Join Dukalangu</h1>
                <p class="portal-subtitle">START YOUR CAREER JOURNEY TODAY</p>
                <div class="divider-line"></div>
                <p class="portal-description">
                    Create an account to unlock thousands of job opportunities and connect with top employers across Tanzania.
                </p>
            </div>
            <div class="branding-footer">
                <p class="copyright">© 2026 Dukalangu. All rights reserved.</p>
            </div>
        </div>

        <!-- Right Side - Register Form -->
        <div class="auth-form-section">
            <div class="form-container">
                <div class="form-header">
                    <h2 class="welcome-title">Create Account</h2>
                    <p class="welcome-subtitle">Join thousands of job seekers and employers</p>
                </div>
                <form method="POST" action="{{ route('register') }}" class="login-form">
                    @csrf

                    <!-- Name Field -->
                    <div class="form-group">
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                            </span>
                            <input id="name" type="text" class="form-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Full Name*">
                        </div>
                        @error('name')
                            <span class="error-message" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="form-group">
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="2" y="4" width="20" height="16" rx="2"/>
                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                                </svg>
                            </span>
                            <input id="email" type="email" class="form-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email Address*">

                        @error('email')
                            <span class="error-message" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                </svg>
                            </span>
                            <input id="password" type="password" class="form-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password*">

                        @error('password')
                            <span class="error-message" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="form-group">
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                </svg>
                            </span>
                            <input id="password-confirm" type="password" class="form-input" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password*">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-signin">
                        Create Account
                    </button>

                    <!-- Sign In Link -->
                    <div class="create-account">
                        <p>Already have an account? <a href="{{ route('login') }}">Sign in here</a></p>
                    </div>

                    <!-- Help Section -->
                    <div class="help-section">
                        <p>Need help? Contact us at <a href="mailto:support@dukalangu.com">support@dukalangu.com</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
