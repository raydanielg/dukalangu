<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ config('app.name') }} Dashboard</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,500,600,700" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --sidebar-width: 260px;
            --primary-green: #16a34a;
            --primary-green-dark: #15803d;
            --primary-green-light: #22c55e;
            --sidebar-bg: #1e293b;
            --sidebar-hover: #334155;
            --sidebar-active: #16a34a;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f8fafc;
            min-height: 100vh;
            color: #334155;
        }

        /* Sidebar Styles - Clean White */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: #ffffff;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
            overflow-y: auto;
            border-right: 1px solid #e2e8f0;
        }

        .sidebar-header {
            padding: 24px 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .sidebar-logo {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            object-fit: contain;
        }

        .sidebar-brand {
            color: #0f172a;
            font-size: 16px;
            font-weight: 600;
            margin: 0;
        }

        .sidebar-subtitle {
            color: #64748b;
            font-size: 12px;
            margin: 0;
        }

        .sidebar-menu {
            padding: 16px 12px;
        }

        .menu-category {
            color: #94a3b8;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 0 12px 8px;
            margin-top: 24px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 10px 12px;
            color: #475569;
            text-decoration: none;
            transition: all 0.2s ease;
            border-radius: 8px;
            margin: 2px 0;
        }

        .menu-item:hover {
            background: #f1f5f9;
            color: #0f172a;
            text-decoration: none;
        }

        .menu-item.active {
            background: #dcfce7;
            color: var(--primary-green);
        }

        .menu-item i {
            font-size: 18px;
            margin-right: 12px;
            width: 20px;
            text-align: center;
        }

        .menu-item span {
            font-size: 14px;
            font-weight: 500;
        }

        .menu-badge {
            margin-left: auto;
            background: var(--primary-green);
            color: white;
            font-size: 10px;
            padding: 2px 8px;
            border-radius: 10px;
        }

        /* Submenu Styles */
        .submenu {
            display: none;
            padding-left: 12px;
        }

        .submenu.show {
            display: block;
        }

        .submenu-item {
            display: block;
            padding: 8px 12px 8px 44px;
            color: #64748b;
            text-decoration: none;
            font-size: 13px;
            transition: all 0.2s ease;
            border-radius: 6px;
            margin: 2px 0;
        }

        .submenu-item:hover {
            color: #0f172a;
            background: #f8fafc;
            text-decoration: none;
        }

        .submenu-item.active {
            color: var(--primary-green);
            background: #dcfce7;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        /* Top Navbar - Clean Minimal */
        .top-navbar {
            background: #ffffff;
            padding: 16px 32px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .page-title {
            font-size: 20px;
            font-weight: 600;
            color: #0f172a;
            margin: 0;
        }

        .top-nav-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .notification-btn {
            position: relative;
            background: none;
            border: none;
            font-size: 20px;
            color: #64748b;
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .notification-btn:hover {
            background: #f1f5f9;
        }

        .notification-badge {
            position: absolute;
            top: 4px;
            right: 4px;
            background: #ef4444;
            color: white;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 10px;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            padding: 6px 12px 6px 6px;
            border-radius: 24px;
            transition: all 0.2s;
        }

        .user-menu:hover {
            background: #f1f5f9;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-green), var(--primary-green-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }

        .user-info {
            text-align: left;
        }

        .user-name {
            font-weight: 600;
            color: #0f172a;
            font-size: 14px;
        }

        .user-role {
            font-size: 12px;
            color: #64748b;
        }

        /* Content Area */
        .content-area {
            padding: 32px;
        }

        /* Stats Cards - Clean Modern */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }

        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            border: 1px solid #f1f5f9;
            transition: all 0.2s ease;
        }

        .stat-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transform: translateY(-2px);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 16px;
        }

        .stat-icon.green { background: #dcfce7; color: #16a34a; }
        .stat-icon.blue { background: #dbeafe; color: #2563eb; }
        .stat-icon.orange { background: #ffedd5; color: #ea580c; }
        .stat-icon.purple { background: #f3e8ff; color: #9333ea; }

        .stat-content h3 {
            font-size: 24px;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
        }

        .stat-content p {
            color: #64748b;
            font-size: 13px;
            margin: 4px 0 0;
        }

        /* Card Component - Clean */
        .card {
            background: white;
            border-radius: 16px;
            border: 1px solid #f1f5f9;
            overflow: hidden;
        }

        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid #f8fafc;
            background: transparent;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 16px;
            font-weight: 600;
            color: #0f172a;
            margin: 0;
        }

        .card-body {
            padding: 24px;
        }

        /* Grid Cards for Products/Files */
        .grid-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .grid-card {
            background: white;
            border-radius: 16px;
            padding: 20px;
            border: 1px solid #f1f5f9;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .grid-card:hover {
            border-color: #dcfce7;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .grid-card-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 16px;
        }

        .grid-card h4 {
            font-size: 15px;
            font-weight: 600;
            color: #0f172a;
            margin: 0 0 4px;
        }

        .grid-card p {
            font-size: 13px;
            color: #64748b;
            margin: 0;
        }

        /* Action Buttons */
        .btn-primary {
            background: var(--primary-green);
            border-color: var(--primary-green);
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
        }

        .btn-primary:hover {
            background: var(--primary-green-dark);
            border-color: var(--primary-green-dark);
        }

        .btn-outline-primary {
            color: var(--primary-green);
            border-color: var(--primary-green);
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
        }

        .btn-outline-primary:hover {
            background: var(--primary-green);
            border-color: var(--primary-green);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('Salama logo.png') }}" alt="{{ config('app.name') }}" class="sidebar-logo">
            <h3 class="sidebar-brand">{{ config('app.name') }}</h3>
            <p class="sidebar-subtitle">Business Dashboard</p>
        </div>

        <nav class="sidebar-menu">
            <p class="menu-category">Main</p>
            <a href="{{ route('home') }}" class="menu-item {{ request()->routeIs('home') ? 'active' : '' }}">
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>

            <p class="menu-category">Products</p>
            <a href="#" class="menu-item" onclick="toggleSubmenu('products-submenu'); return false;">
                <i class="bi bi-box-seam-fill"></i>
                <span>Products</span>
                <i class="bi bi-chevron-down ms-auto" style="font-size: 12px;"></i>
            </a>
            <div id="products-submenu" class="submenu">
                <a href="{{ route('products.index') }}" class="submenu-item {{ request()->routeIs('products.index') ? 'active' : '' }}">All Products</a>
                <a href="{{ route('products.in-stock') }}" class="submenu-item {{ request()->routeIs('products.in-stock') ? 'active' : '' }}">In Stock</a>
                <a href="{{ route('products.out-of-stock') }}" class="submenu-item {{ request()->routeIs('products.out-of-stock') ? 'active' : '' }}">Out of Stock</a>
                <a href="{{ route('products.create') }}" class="submenu-item {{ request()->routeIs('products.create') ? 'active' : '' }}">Add Product</a>
            </div>

            <p class="menu-category">Sales</p>
            <a href="{{ route('pos') }}" class="menu-item {{ request()->routeIs('pos') ? 'active' : '' }}">
                <i class="bi bi-cart-fill"></i>
                <span>POS</span>
                <span class="menu-badge">New</span>
            </a>
            <a href="{{ route('orders') }}" class="menu-item {{ request()->routeIs('orders') ? 'active' : '' }}">
                <i class="bi bi-receipt"></i>
                <span>Orders</span>
            </a>

            <p class="menu-category">Business</p>
            <a href="#" class="menu-item">
                <i class="bi bi-graph-up"></i>
                <span>Analytics</span>
                <span class="menu-badge">Soon</span>
            </a>
            <a href="#" class="menu-item">
                <i class="bi bi-people-fill"></i>
                <span>Customers</span>
            </a>

            <p class="menu-category">Settings</p>
            <a href="#" class="menu-item">
                <i class="bi bi-shop"></i>
                <span>Store Settings</span>
            </a>
            <a href="#" class="menu-item">
                <i class="bi bi-gear-fill"></i>
                <span>Settings</span>
            </a>

            <p class="menu-category">Account</p>
            <a href="#" class="menu-item">
                <i class="bi bi-person-fill"></i>
                <span>My Profile</span>
            </a>
            <a href="#" class="menu-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Navbar -->
        <nav class="top-navbar">
            <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
            <div class="top-nav-right">
                <button class="notification-btn">
                    <i class="bi bi-bell"></i>
                    <span class="notification-badge">3</span>
                </button>
                <div class="user-menu dropdown">
                    <div class="user-avatar">
                        {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                    </div>
                    <div class="user-info">
                        <div class="user-name">{{ Auth::user()->name ?? 'User' }}</div>
                        <div class="user-role">Store Owner</div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Content Area -->
        <div class="content-area">
            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSubmenu(id) {
            const submenu = document.getElementById(id);
            submenu.classList.toggle('show');
        }
    </script>
    @yield('scripts')
</body>
</html>
