@extends('layouts.auth')

@section('title', 'Set New Password')
@section('meta_description', 'Set your new Dukalangu password securely. Regain access to your account and continue your job search.')
@section('meta_keywords', 'reset password, new password, Dukalangu account recovery')

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
                <h1 class="portal-title">New Password</h1>
                <p class="portal-subtitle">SECURE YOUR ACCOUNT</p>
                <div class="divider-line"></div>
                <p class="portal-description">
                    Create a strong password to protect your Dukalangu account and continue your career journey.
                </p>
            </div>
            <div class="branding-footer">
                <p class="copyright">© 2026 Dukalangu. All rights reserved.</p>
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
                        <p>Need help? Contact us at <a href="mailto:support@dukalangu.com">support@dukalangu.com</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
