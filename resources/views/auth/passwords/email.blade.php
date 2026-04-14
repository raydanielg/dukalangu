@extends('layouts.auth')

@section('title', 'Reset Password')
@section('meta_description', 'Reset your Salamapay account password. Securely regain access to your payment and job platform account.')
@section('meta_keywords', 'reset password, forgot password, Salamapay password recovery, secure account recovery')

@section('content')
<div class="auth-container">
    <div class="auth-wrapper">
        <!-- Left Side - Branding -->
        <div class="auth-branding">
            <div class="branding-content">
                <div class="logo-section">
                    <div class="logo-circle">
                        <!-- Dukalangu Logo -->
                        <img src="{{ asset('Salama logo2 .png') }}" alt="Salamapay" class="salamapay-logo" style="width: 100px; height: auto; filter: brightness(0) invert(1);">
                    </div>
                </div>
                <h1 class="portal-title">Password Recovery</h1>
                <p class="portal-subtitle">GET BACK TO YOUR ACCOUNT</p>
                <div class="divider-line"></div>
                <p class="portal-description">
                    Enter your email address and we'll send you a link to securely reset your password.
                </p>
            </div>
            <div class="branding-footer">
                <p class="copyright">© 2026 Salamapay. All rights reserved.</p>
            </div>
        </div>

        <!-- Right Side - Reset Form -->
        <div class="auth-form-section">
            <div class="form-container">
                <div class="form-header">
                    <h2 class="welcome-title">Reset Password</h2>
                    <p class="welcome-subtitle">Enter your email to receive reset instructions</p>
                </div>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="login-form">
                    @csrf

                    <!-- Email Field -->
                    <div class="form-group">
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="2" y="4" width="20" height="16" rx="2"/>
                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                                </svg>
                            </span>
                            <input id="email" type="email" class="form-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Address*">
                        </div>
                        @error('email')
                            <span class="error-message" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-signin">
                        Send Password Reset Link
                    </button>

                    <!-- Back to Login -->
                    <div class="create-account">
                        <p>Remember your password? <a href="{{ route('login') }}">Sign in here</a></p>
                    </div>

                    <!-- Help Section -->
                    <div class="help-section">
                        <p>Need help? Contact us at <a href="mailto:support@salamapay.co.tz">support@salamapay.co.tz</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
