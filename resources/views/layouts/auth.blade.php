<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags - Power Packed -->
    <title>@yield('title', 'Dukalangu') | Tanzania\'s Premier Job Portal - Find Your Dream Career</title>
    <meta name="description" content="@yield('meta_description', 'Dukalangu is Tanzania\'s leading job portal connecting talent with opportunities. Find jobs, post vacancies, and accelerate your career today.')">
    <meta name="keywords" content="@yield('meta_keywords', 'jobs Tanzania, employment, career opportunities, job portal,招聘, ajira, kazi Tanzania, Dukalangu')">
    <meta name="author" content="Dukalangu Team">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', 'Dukalangu - Tanzania\'s Premier Job Portal')">
    <meta property="og:description" content="@yield('og_description', 'Connect with top employers and find your dream job in Tanzania. Thousands of opportunities await!')">
    <meta property="og:image" content="@yield('og_image', asset('images/dukalangu-og.jpg'))">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('twitter_title', 'Dukalangu - Tanzania\'s Premier Job Portal')">
    <meta property="twitter:description" content="@yield('twitter_description', 'Connect with top employers and find your dream job in Tanzania.')">
    <meta property="twitter:image" content="@yield('twitter_image', asset('images/dukalangu-og.jpg'))">

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
