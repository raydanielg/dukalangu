@extends('layouts.auth')

@section('title', 'Set New Password')
@section('meta_description', 'Set your new '.config('app.name').' password securely. Regain access to your online store and continue managing your business.')
@section('meta_keywords', 'reset password, new password, '.config('app.name').' account recovery, secure password reset')

@section('content')
<div class="auth-container">
    <div class="auth-wrapper">
        <!-- Left Side - Branding -->
        <div class="auth-branding">
            <div class="branding-content">
                <div class="logo-section">
                    <div class="logo-circle">
                        <img src="{{ asset('Salama logo2 .png') }}" alt="Salamapay" class="salamapay-logo" style="width: 120px; height: auto;">
                    </div>
                </div>
                <h1 class="portal-title">New Password</h1>
                <p class="portal-subtitle">SECURE YOUR BUSINESS ACCOUNT</p>
                <div class="divider-line"></div>
                <p class="portal-description">
                    Create a strong password to protect your {{ config('app.name') }} account and continue managing your online store and orders.
                </p>
            </div>
            <div class="branding-footer">
                <p class="copyright">© 2026 {{ config('app.name') }}. All rights reserved.</p>
            </div>
        </div>

        <!-- Right Side - Reset Form -->
        <div class="auth-form-section">
            <div class="form-container">
                <div class="form-header">
                    <h2 class="welcome-title">Set New Password</h2>
                    <p class="welcome-subtitle">Create a secure password for your account</p>
                </div>
                <form method="POST" action="{{ route('password.update') }}" class="login-form">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <!-- Email Field -->
                    <div class="form-group">
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="2" y="4" width="20" height="16" rx="2"/>
                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                                </svg>
                            </span>
                            <input id="email" type="email" class="form-input @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="Email Address*">

                        </div>
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
                            <input id="password" type="password" class="form-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="New Password*">

                        </div>
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
                            <input id="password-confirm" type="password" class="form-input" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm New Password*">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-signin">
                        Reset Password
                    </button>

                    <!-- Back to Login -->
                    <div class="create-account">
                        <p>Remember your password? <a href="{{ route('login') }}">Sign in here</a></p>
                    </div>

                    <!-- Help Section -->
                    <div class="help-section">
                        <p>Need help? Contact us at <a href="mailto:support@{{ strtolower(str_replace(' ', '', config('app.name'))) }}.co.tz">support@{{ strtolower(str_replace(' ', '', config('app.name'))) }}.co.tz</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
