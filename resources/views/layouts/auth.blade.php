<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags - Power Packed -->
    <title>@yield('title', '{{ config('app.name') }}') | Tanzania\'s Trusted E-Commerce & Business Platform - Sell & Grow</title>
    <meta name="description" content="@yield('meta_description', '{{ config('app.name') }} helps Tanzanian entrepreneurs create online stores, advertise products, and receive orders seamlessly. Start your business journey today!')">
    <meta name="keywords" content="@yield('meta_keywords', '{{ config('app.name') }}, Tanzania e-commerce, online store, sell products, business platform, matangazo, biashara mtandaoni, wafanyabiashara, dukani mtandaoni')">
    <meta name="author" content="{{ config('app.name') }} Team">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', '{{ config('app.name') }} - Tanzania\'s Trusted E-Commerce Platform')">
    <meta property="og:description" content="@yield('og_description', 'Create your online store, advertise products, and receive orders seamlessly. Join thousands of Tanzanian entrepreneurs!')">
    <meta property="og:image" content="@yield('og_image', asset('Salama logo.png'))">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('twitter_title', '{{ config('app.name') }} - Tanzania\'s Trusted E-Commerce Platform')">
    <meta property="twitter:description" content="@yield('twitter_description', 'Create your online store and sell products seamlessly.')">
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
