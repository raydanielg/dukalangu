@extends('layouts.auth')

@section('title', 'Reset Password')
@section('meta_description', 'Reset your account password. Securely regain access to your online store and business dashboard.')
@section('meta_keywords', 'reset password, forgot password, password recovery, business account recovery')

@section('content')
<div class="auth-container">
    <div class="auth-wrapper">
        <!-- Left Side - Branding -->
        <div class="auth-branding">
            <div class="branding-content">
                <div class="logo-section">
                    <!-- Logo without box/circle design -->
                    <img src="{{ asset('Salama logo.png') }}" alt="{{ config('app.name') }}" class="salamapay-logo" style="width: 150px; height: auto; margin-bottom: 16px;">
                </div>
                <h1 class="portal-title">Password Recovery</h1>
                <p class="portal-subtitle">GET BACK TO YOUR BUSINESS</p>
                <div class="divider-line"></div>
                <p class="portal-description">
                    Enter your email address and we'll send you a link to securely reset your password and regain access to your store.
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

                    <!-- Phone Number Field -->
                    <div class="form-group">
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                </svg>
                            </span>
                            <input id="phone" type="tel" class="form-input @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="tel" autofocus placeholder="Phone Number*" pattern="[0-9]{10}" title="Enter 10 digit phone number (e.g., 0712345678)">
                        </div>
                        @error('phone')
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
                        <p>Need help? Contact us at <a href="mailto:support@{{ strtolower(str_replace(' ', '', config('app.name'))) }}.co.tz">support@{{ strtolower(str_replace(' ', '', config('app.name'))) }}.co.tz</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
