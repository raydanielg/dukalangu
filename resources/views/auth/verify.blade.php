@extends('layouts.auth')

@section('title', 'Verify Email')
@section('meta_description', 'Verify your email address on Salamapay. Complete your registration and start accessing secure payments and job opportunities.')
@section('meta_keywords', 'verify email, email verification, Salamapay confirmation, account activation')

@section('content')
<div class="auth-container">
    <div class="auth-wrapper">
        <!-- Left Side - Branding -->
        <div class="auth-branding">
            <div class="branding-content">
                <div class="logo-section">
                    <div class="logo-circle">
                        <img src="{{ asset('Salama logo2 .png') }}" alt="Salamapay" class="salamapay-logo" style="width: 100px; height: auto; filter: brightness(0) invert(1);">
                    </div>
                </div>
                <h1 class="portal-title">Verify Email</h1>
                <p class="portal-subtitle">COMPLETE YOUR REGISTRATION</p>
                <div class="divider-line"></div>
                <p class="portal-description">
                    Please verify your email address to activate your Salamapay account and start accessing secure payments and job opportunities.
                </p>
            </div>
            <div class="branding-footer">
                <p class="copyright">© 2026 Salamapay. All rights reserved.</p>
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
                        <p>Need help? Contact us at <a href="mailto:support@salamapay.co.tz">support@salamapay.co.tz</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
