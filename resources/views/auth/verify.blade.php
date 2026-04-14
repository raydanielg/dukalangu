@extends('layouts.auth')

@section('title', 'Verify Email')
@section('meta_description', 'Verify your email address on Dukalangu. Complete your registration and start exploring job opportunities.')
@section('meta_keywords', 'verify email, email verification, Dukalangu confirmation')

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
                <h1 class="portal-title">Verify Email</h1>
                <p class="portal-subtitle">COMPLETE YOUR REGISTRATION</p>
                <div class="divider-line"></div>
                <p class="portal-description">
                    Please verify your email address to activate your Dukalangu account and start your job search.
                </p>
            </div>
            <div class="branding-footer">
                <p class="copyright">© 2026 Dukalangu. All rights reserved.</p>
            </div>
        </div>

        <!-- Right Side - Verify Section -->
        <div class="auth-form-section">
            <div class="form-container">
                <div class="form-header">
                    <h2 class="welcome-title">Verify Your Email</h2>
                    <p class="welcome-subtitle">Check your inbox for the verification link</p>
                </div>

                <div class="verification-content">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            <strong>Success!</strong> A fresh verification link has been sent to your email address.
                        </div>
                    @endif

                    <div class="verification-message">
                        <p class="mb-4">
                            Before proceeding, please check your email for a verification link.
                        </p>
                        <p class="mb-4">
                            If you did not receive the email, click the button below to request another verification link.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('verification.resend') }}" class="login-form">
                        @csrf
                        <button type="submit" class="btn-signin">
                            Resend Verification Link
                        </button>
                    </form>

                    <div class="create-account mt-4">
                        <p>Already verified? <a href="{{ route('login') }}">Sign in here</a></p>
                    </div>

                    <div class="help-section">
                        <p>Need help? Contact us at <a href="mailto:support@dukalangu.com">support@dukalangu.com</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
