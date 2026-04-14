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
                <!-- Welcome Image with Animation -->
                <div class="welcome-image-section" style="margin-bottom: 20px; text-align: center;">
                    <img src="{{ asset('Karibu salamapay.png') }}" alt="Karibu {{ config('app.name') }}" class="welcome-image" style="width: 180px; height: auto; animation: fadeInDown 1s ease-out;">
                </div>

                <!-- Decorative Line -->
                <div class="decorative-line" style="width: 60px; height: 3px; background: linear-gradient(90deg, var(--primary-green-light), var(--primary-green), var(--primary-green-dark)); margin: 0 auto 20px; border-radius: 2px; animation: expandLine 1.5s ease-out;"></div>

                <!-- App Preview Image with Float Animation -->
                <div class="app-preview-section" style="margin-bottom: 20px; text-align: center;">
                    <img src="{{ asset('app.png') }}" alt="{{ config('app.name') }} App" class="app-image" style="width: 200px; height: auto; animation: floatAnimation 3s ease-in-out infinite, fadeInUp 1s ease-out;">
                </div>

                <!-- Logo -->
                <div class="logo-section" style="animation: fadeIn 1.5s ease-out;">
                    <img src="{{ asset('Salama logo.png') }}" alt="{{ config('app.name') }}" class="salamapay-logo" style="width: 100px; height: auto; margin-bottom: 12px;">
                </div>

                <!-- Title with Animation -->
                <h1 class="portal-title" style="animation: slideInLeft 1s ease-out;">{{ config('app.name') }}</h1>

                <!-- Subtitle -->
                <p class="portal-subtitle" style="animation: fadeIn 1.2s ease-out;">CREATE YOUR ONLINE STORE & SELL ANYWHERE</p>

                <!-- Animated Divider -->
                <div class="divider-line" style="animation: expandWidth 1s ease-out;"></div>

                <!-- Description -->
                <p class="portal-description" style="animation: fadeInUp 1.3s ease-out;">
                    Manage your business online. Create your store, advertise products, receive orders, and grow your customer base - all in one seamless platform.
                </p>
            </div>

            <!-- Animated Footer -->
            <div class="branding-footer" style="animation: fadeIn 2s ease-out;">
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

                    <!-- Divider -->
                    <div style="display: flex; align-items: center; margin: 20px 0;">
                        <div style="flex: 1; height: 1px; background: var(--border-color);"></div>
                        <span style="padding: 0 15px; color: var(--text-gray); font-size: 12px;">OR</span>
                        <div style="flex: 1; height: 1px; background: var(--border-color);"></div>
                    </div>

                    <!-- Social Login Buttons -->
                    <div class="social-login" style="display: flex; flex-direction: column; gap: 12px;">
                        <!-- Google Sign In -->
                        <a href="#" onclick="alert('Google login coming soon!'); return false;" class="social-btn" style="display: flex; align-items: center; justify-content: center; gap: 10px; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; text-decoration: none; color: var(--text-dark); font-weight: 500; transition: all 0.2s; background: white; cursor: not-allowed; opacity: 0.8;">
                            <svg width="20" height="20" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                            </svg>
                            Sign in with Google <span style="font-size: 10px; color: #999;">(Soon)</span>
                        </a>

                        <!-- Facebook Sign In -->
                        <a href="#" onclick="alert('Facebook login coming soon!'); return false;" class="social-btn" style="display: flex; align-items: center; justify-content: center; gap: 10px; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; text-decoration: none; color: var(--text-dark); font-weight: 500; transition: all 0.2s; background: white; cursor: not-allowed; opacity: 0.8;">
                            <svg width="20" height="20" viewBox="0 0 24 24">
                                <path fill="#1877F2" d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                            Sign in with Facebook <span style="font-size: 10px; color: #999;">(Soon)</span>
                        </a>

                        <!-- Twitter/X Sign In -->
                        <a href="#" onclick="alert('Twitter/X login coming soon!'); return false;" class="social-btn" style="display: flex; align-items: center; justify-content: center; gap: 10px; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; text-decoration: none; color: var(--text-dark); font-weight: 500; transition: all 0.2s; background: white; cursor: not-allowed; opacity: 0.8;">
                            <svg width="20" height="20" viewBox="0 0 24 24">
                                <path fill="#000000" d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                            Sign in with X <span style="font-size: 10px; color: #999;">(Soon)</span>
                        </a>
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
