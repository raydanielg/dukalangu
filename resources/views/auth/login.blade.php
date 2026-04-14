@extends('layouts.auth')

@section('title', 'Sign In')
@section('meta_description', 'Sign in to Salamapay - Tanzania\'s trusted payment and job platform. Access secure payments and job opportunities.')
@section('meta_keywords', 'login Salamapay, sign in, payment portal login, secure payments Tanzania, job portal login')

@section('content')
<div class="auth-container">
    <div class="auth-wrapper">
        <!-- Left Side - Branding -->
        <div class="auth-branding">
            <div class="branding-content">
                <div class="logo-section">
                    <div class="logo-circle">
                        <!-- Salamapay Logo White Version -->
                        <img src="{{ asset('Salama logo2 .png') }}" alt="Salamapay" class="salamapay-logo" style="width: 120px; height: auto;">
                    </div>
                </div>
                <h1 class="portal-title">Salamapay</h1>
                <p class="portal-subtitle">SECURE PAYMENTS & CAREER OPPORTUNITIES</p>
                <div class="divider-line"></div>
                <p class="portal-description">
                    Connect with top employers and process secure payments all in one platform. Your trusted partner for financial growth and career success.
                </p>
            </div>
            <div class="branding-footer">
                <p class="copyright">© 2026 Salamapay. All rights reserved.</p>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="auth-form-section">
            <div class="form-container">
                <!-- Language Selector -->
                <div class="language-selector">
                    <button class="lang-btn">
                        <span class="dropdown-icon">▾</span>
                        <span class="flag-icon">🇬🇧</span>
                    </button>
                </div>

                <div class="form-header">
                    <h2 class="welcome-title">Welcome back</h2>
                    <p class="welcome-subtitle">Sign in to your account</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="login-form">
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

                    <!-- Password Field -->
                    <div class="form-group">
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                </svg>
                            </span>
                            <input id="password" type="password" class="form-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password*">
                            <button type="button" class="toggle-password" onclick="togglePassword()">
                                <svg id="eye-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                <svg id="eye-off-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: none;">
                                    <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/>
                                    <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/>
                                    <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/>
                                    <line x1="2" x2="22" y1="2" y2="22"/>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <span class="error-message" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Forgot Password -->
                    <div class="forgot-password">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Forgot password?</a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-signin">
                        Sign In
                    </button>

                    <!-- Create Account -->
                    <div class="create-account">
                        <p>Don't have an account? <a href="{{ route('register') }}">Create an account</a></p>
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

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eye-icon');
    const eyeOffIcon = document.getElementById('eye-off-icon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.style.display = 'none';
        eyeOffIcon.style.display = 'block';
    } else {
        passwordInput.type = 'password';
        eyeIcon.style.display = 'block';
        eyeOffIcon.style.display = 'none';
    }
}
</script>
@endsection
