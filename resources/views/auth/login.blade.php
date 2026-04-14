@extends('layouts.auth')

@section('title', 'Sign In')
@section('meta_description', 'Sign in to your account. Manage your online store, products, and orders all in one place.')
@section('meta_keywords', 'login, sign in, business account Tanzania, online store login, manage products')

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
                <h1 class="portal-title">{{ config('app.name') }}</h1>
                <p class="portal-subtitle">CREATE YOUR ONLINE STORE & SELL ANYWHERE</p>
                <div class="divider-line"></div>
                <p class="portal-description">
                    Manage your business online. Create your store, advertise products, receive orders, and grow your customer base - all in one seamless platform.
                </p>
            </div>
            <div class="branding-footer">
                <p class="copyright">© 2026 {{ config('app.name') }}. All rights reserved.</p>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="auth-form-section">
            <div class="form-container">
                <div class="form-header" style="margin-top: 20px;">
                    <h2 class="welcome-title">Welcome back</h2>
                    <p class="welcome-subtitle">Sign in to your account</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="login-form">
                    @csrf

                    <!-- Phone Number Field with Country Code -->
                    <div class="form-group">
                        <div class="input-wrapper" style="display: flex; align-items: center; border: 1px solid var(--border-color); border-radius: 8px; overflow: hidden;">
                            <!-- Country Code Prefix -->
                            <span style="padding: 12px 10px; background: #f3f4f6; border-right: 1px solid var(--border-color); color: var(--text-dark); font-weight: 600; font-size: 14px; white-space: nowrap;">
                                🇹🇿 +255
                            </span>
                            <input id="phone" type="tel" class="form-input @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="tel" autofocus placeholder="Phone Number*" pattern="[0-9]{9}" title="Enter 9 digit phone number without country code (e.g., 712345678)" style="border: none; border-radius: 0; flex: 1;">
                        </div>
                        @error('phone')
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

                    <!-- Create Account Link -->
                    <div class="create-account">
                        <p>Don't have an account? <a href="{{ route('register') }}" style="color: var(--primary-green); font-weight: 700;">Create an account here</a></p>
                    </div>

                    <!-- Social Media Links -->
                    <div class="social-media-links" style="text-align: center; margin: 20px 0;">
                        <p style="font-size: 12px; color: var(--text-gray); margin-bottom: 10px;">Follow us on social media</p>
                        <div style="display: flex; justify-content: center; gap: 16px;">
                            <!-- Instagram -->
                            <a href="https://instagram.com/salamapay" target="_blank" style="color: var(--text-gray); transition: color 0.2s;">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                                </svg>
                            </a>
                            <!-- Facebook -->
                            <a href="https://facebook.com/salamapay" target="_blank" style="color: var(--text-gray); transition: color 0.2s;">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                                </svg>
                            </a>
                            <!-- Twitter/X -->
                            <a href="https://twitter.com/salamapay" target="_blank" style="color: var(--text-gray); transition: color 0.2s;">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/>
                                </svg>
                            </a>
                            <!-- WhatsApp -->
                            <a href="https://wa.me/255700000000" target="_blank" style="color: var(--text-gray); transition: color 0.2s;">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
                                </svg>
                            </a>
                            <!-- TikTok -->
                            <a href="https://tiktok.com/@salamapay" target="_blank" style="color: var(--text-gray); transition: color 0.2s;">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/>
                                </svg>
                            </a>
                        </div>
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
