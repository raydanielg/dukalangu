@extends('layouts.auth')

@section('title', 'Confirm Password')
@section('meta_description', 'Confirm your Dukalangu password to continue. Secure access to your job portal account.')
@section('meta_keywords', 'confirm password, verify password, Dukalangu security')

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
                <h1 class="portal-title">Security Check</h1>
                <p class="portal-subtitle">PROTECTING YOUR ACCOUNT</p>
                <div class="divider-line"></div>
                <p class="portal-description">
                    Please confirm your password to continue accessing your Dukalangu account securely.
                </p>
            </div>
            <div class="branding-footer">
                <p class="copyright">© 2026 Dukalangu. All rights reserved.</p>
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
                        <p>Need help? Contact us at <a href="mailto:support@dukalangu.com">support@dukalangu.com</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
