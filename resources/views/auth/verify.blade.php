@extends('layouts.auth')

@section('title', 'Verify Email')
@section('meta_description', 'Verify your email address. Complete your registration and start creating your online store and selling products.')
@section('meta_keywords', 'verify email, email verification, confirmation, business account activation, online store setup')

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
                <h1 class="portal-title">Verify Email</h1>
                <p class="portal-subtitle">ACTIVATE YOUR BUSINESS ACCOUNT</p>
                <div class="divider-line"></div>
                <p class="portal-description">
                    Please verify your email address to activate your {{ config('app.name') }} account and start creating your online store, advertising products, and receiving orders.
                </p>
            </div>
            <div class="branding-footer">
                <p class="copyright">© 2026 {{ config('app.name') }}. All rights reserved.</p>
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
                        <p>Need help? Contact us at <a href="mailto:info@zerixa.co.tz">info@zerixa.co.tz</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
