@extends('layouts.auth')

@section('title', 'Confirm Password')
@section('meta_description', 'Confirm your '.config('app.name').' password to continue. Secure access to your online store and business dashboard.')
@section('meta_keywords', 'confirm password, verify password, '.config('app.name').' security, business account access')

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
                <h1 class="portal-title">Security Check</h1>
                <p class="portal-subtitle">PROTECTING YOUR BUSINESS</p>
                <div class="divider-line"></div>
                <p class="portal-description">
                    Please confirm your password to continue accessing your {{ config('app.name') }} store and managing your business securely.
                </p>
            </div>
            <div class="branding-footer">
                <p class="copyright">© 2026 {{ config('app.name') }}. All rights reserved.</p>
            </div>
        </div>

        <!-- Right Side - Confirm Form -->
        <div class="auth-form-section">
            <div class="form-container">
                <div class="form-header">
                    <h2 class="welcome-title">Confirm Password</h2>
                    <p class="welcome-subtitle">Please confirm your password before continuing</p>
                </div>

                <form method="POST" action="{{ route('password.confirm') }}" class="login-form">
                    @csrf

                    <!-- Password Field -->
                    <div class="form-group">
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                </svg>
                            </span>
                            <input id="password" type="password" class="form-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password*">

                        </div>
                        @error('password')
                            <span class="error-message" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-signin">
                        Confirm Password
                    </button>

                    <!-- Forgot Password Link -->
                    @if (Route::has('password.request'))
                        <div class="create-account">
                            <p><a href="{{ route('password.request') }}">Forgot your password?</a></p>
                        </div>
                    @endif

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
