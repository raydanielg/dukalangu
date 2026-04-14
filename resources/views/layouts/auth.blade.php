<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags - Power Packed for Salamapay -->
    <title>@yield('title', 'Salamapay') | Tanzania\'s Trusted Payment & Job Platform - Secure & Fast</title>
    <meta name="description" content="@yield('meta_description', 'Salamapay is Tanzania\'s trusted platform for secure payments, job opportunities, and career growth. Connect with employers, process payments, and build your future today.')">
    <meta name="keywords" content="@yield('meta_keywords', 'Salamapay, payments Tanzania, mobile money, job portal, secure payments, employment, career opportunities, ajira, kazi Tanzania, fintech Tanzania')">
    <meta name="author" content="Salamapay Team">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', 'Salamapay - Tanzania\'s Trusted Payment & Job Platform')">
    <meta property="og:description" content="@yield('og_description', 'Secure payments and job opportunities in one platform. Join thousands of Tanzanians trusting Salamapay for their career and financial needs!')">
    <meta property="og:image" content="@yield('og_image', asset('Salama logo.png'))">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('twitter_title', 'Salamapay - Tanzania\'s Trusted Payment & Job Platform')">
    <meta property="twitter:description" content="@yield('twitter_description', 'Secure payments and job opportunities in one trusted platform.')">
    <meta property="twitter:image" content="@yield('twitter_image', asset('Salama logo.png'))">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,500,600,700" rel="stylesheet">

    <!-- Auth Styles -->
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
</head>
<body class="auth-body">
    @yield('content')
</body>
</html>
