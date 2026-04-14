<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ config('app.name') }} Dashboard</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Inter:400,500,600,700" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        :root {
            --sidebar-width: 240px;
            --primary: #0d9488;
            --primary-dark: #0f766e;
            --sidebar-bg: #0f172a;
            --sidebar-hover: #1e293b;
            --sidebar-active: #0d9488;
            --text-gray: #64748b;
            --bg-light: #f1f5f9;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f8fafc;
            min-height: 100vh;
            color: #334155;
        }

        /* Sidebar - Dark Style Like Snippe */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-brand {
            color: white;
            font-size: 20px;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-brand img {
            width: 32px;
            height: 32px;
            border-radius: 6px;
        }

        .sidebar-menu {
            flex: 1;
            padding: 16px 0;
        }

        .menu-section-title {
            color: #64748b;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 8px 20px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            color: #94a3b8;
            text-decoration: none;
            transition: all 0.15s ease;
            font-size: 14px;
            position: relative;
        }

        .menu-item:hover {
            color: white;
            background: var(--sidebar-hover);
            text-decoration: none;
        }

        .menu-item.active {
            color: white;
            background: rgba(13, 148, 136, 0.1);
        }

        .menu-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: var(--primary);
        }

        .menu-item i {
            font-size: 18px;
            margin-right: 12px;
            width: 20px;
            text-align: center;
            opacity: 0.8;
        }

        .menu-item .badge-new {
            margin-left: auto;
            background: #ef4444;
            color: white;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 4px;
        }

        .menu-item .badge-beta {
            margin-left: auto;
            background: #6366f1;
            color: white;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 4px;
        }

        .sidebar-footer {
            padding: 16px 0;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        /* Submenu */
        .has-submenu {
            cursor: pointer;
        }

        .submenu {
            display: none;
            background: rgba(0,0,0,0.2);
        }

        .submenu.show {
            display: block;
        }

        .submenu-item {
            display: block;
            padding: 8px 20px 8px 52px;
            color: #64748b;
            text-decoration: none;
            font-size: 13px;
            transition: all 0.15s ease;
        }

        .submenu-item:hover {
            color: white;
            text-decoration: none;
        }

        .submenu-item.active {
            color: var(--primary);
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            background: #f8fafc;
        }

        /* Top Header - Snippe Style */
        .top-header {
            background: white;
            padding: 16px 32px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .top-header-left h1 {
            font-size: 20px;
            font-weight: 600;
            color: #0f172a;
            margin: 0;
        }

        .top-header-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .header-search {
            position: relative;
            display: flex;
            align-items: center;
        }

        .header-search i {
            position: absolute;
            left: 12px;
            color: #94a3b8;
            font-size: 14px;
        }

        .header-search input {
            padding: 8px 12px 8px 36px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            width: 240px;
            outline: none;
        }

        .header-search input:focus {
            border-color: var(--primary);
        }

        .header-btn {
            background: none;
            border: none;
            font-size: 18px;
            color: #64748b;
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
            transition: all 0.2s;
            position: relative;
        }

        .header-btn:hover {
            background: #f1f5f9;
        }

        .header-badge {
            position: absolute;
            top: 4px;
            right: 4px;
            background: #ef4444;
            color: white;
            font-size: 10px;
            padding: 2px 5px;
            border-radius: 50%;
        }

        .header-user {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 4px 8px 4px 4px;
            border-radius: 20px;
            transition: all 0.2s;
        }

        .header-user:hover {
            background: #f1f5f9;
        }

        .header-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 13px;
        }

        .header-username {
            font-size: 13px;
            color: #475569;
            font-weight: 500;
        }

        /* Content Wrapper */
        .content-wrapper {
            padding: 24px 32px;
        }

        /* Welcome Banner */
        .welcome-banner {
            background: white;
            border-radius: 12px;
            padding: 24px 32px;
            margin-bottom: 24px;
            border: 1px solid #e2e8f0;
        }

        .welcome-banner h2 {
            font-size: 20px;
            font-weight: 600;
            color: #0f172a;
            margin: 0 0 8px;
        }

        .welcome-banner p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
        }

        /* Stats Cards - Snippe Style */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 24px;
        }

        @media (max-width: 1200px) {
            .stats-row { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            .stats-row { grid-template-columns: 1fr; }
        }

        .stat-box {
            background: white;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #e2e8f0;
            display: flex;
            flex-direction: column;
        }

        .stat-box-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .stat-box-title {
            font-size: 13px;
            color: #64748b;
            font-weight: 500;
        }

        .stat-box-icon {
            color: #94a3b8;
            font-size: 16px;
        }

        .stat-box-value {
            font-size: 28px;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
        }

        .stat-box-subtitle {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 4px;
        }

        /* Action Cards */
        .action-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 24px;
        }

        @media (max-width: 992px) {
            .action-cards { grid-template-columns: 1fr; }
        }

        .action-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #e2e8f0;
            display: flex;
            align-items: flex-start;
            gap: 16px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .action-card:hover {
            border-color: var(--primary);
            box-shadow: 0 4px 12px rgba(13, 148, 136, 0.1);
        }

        .action-card-icon {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #0f172a;
            flex-shrink: 0;
        }

        .action-card-content h4 {
            font-size: 14px;
            font-weight: 600;
            color: #0f172a;
            margin: 0 0 4px;
        }

        .action-card-content p {
            font-size: 13px;
            color: #64748b;
            margin: 0;
        }

        .action-card-badge {
            background: #ef4444;
            color: white;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 4px;
            margin-left: 8px;
        }

        /* Content Cards */
        .content-card {
            background: white;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }

        .content-card-header {
            padding: 16px 20px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .content-card-title {
            font-size: 16px;
            font-weight: 600;
            color: #0f172a;
            margin: 0;
        }

        .content-card-body {
            padding: 20px;
        }

        /* Data Table */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            text-align: left;
            padding: 12px 16px;
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #f1f5f9;
        }

        .data-table td {
            padding: 16px;
            font-size: 14px;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        .data-table tr:hover td {
            background: #f8fafc;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-success {
            background: #dcfce7;
            color: #16a34a;
        }

        .badge-warning {
            background: #fef3c7;
            color: #d97706;
        }

        .badge-danger {
            background: #fee2e2;
            color: #dc2626;
        }

        .badge-secondary {
            background: #f1f5f9;
            color: #64748b;
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
    <!-- Sidebar - Snippe Style -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <h3 class="sidebar-brand">
                <img src="{{ asset('Salama logo.png') }}" alt="{{ config('app.name') }}">
                {{ config('app.name') }}
            </h3>
        </div>

        <nav class="sidebar-menu">
            <div class="menu-section-title">Main Menu</div>
            <a href="{{ route('home') }}" class="menu-item {{ request()->routeIs('home') ? 'active' : '' }}">
                <i class="bi bi-grid"></i>
                <span>Overview</span>
            </a>
            <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
            <a href="#" class="menu-item has-submenu" onclick="toggleSubmenu('analytics-submenu'); return false;">
                <i class="bi bi-graph-up"></i>
                <span>Analytics</span>
                <i class="bi bi-chevron-down ms-auto small"></i>
            </a>
            <div id="analytics-submenu" class="submenu">
                <a href="#" class="submenu-item">Sales Report</a>
                <a href="#" class="submenu-item">Products Report</a>
            </div>

            <div class="menu-section-title">Business</div>
            <a href="#" class="menu-item has-submenu" onclick="toggleSubmenu('products-submenu'); return false;">
                <i class="bi bi-box-seam"></i>
                <span>Products</span>
                <i class="bi bi-chevron-down ms-auto small"></i>
            </a>
            <div id="products-submenu" class="submenu">
                <a href="{{ route('products.index') }}" class="submenu-item {{ request()->routeIs('products.index') ? 'active' : '' }}">All Products</a>
                <a href="{{ route('products.in-stock') }}" class="submenu-item {{ request()->routeIs('products.in-stock') ? 'active' : '' }}">In Stock</a>
                <a href="{{ route('products.out-of-stock') }}" class="submenu-item {{ request()->routeIs('products.out-of-stock') ? 'active' : '' }}">Out of Stock</a>
                <a href="{{ route('products.create') }}" class="submenu-item {{ request()->routeIs('products.create') ? 'active' : '' }}">Add Product</a>
            </div>
            <a href="{{ route('orders') }}" class="menu-item {{ request()->routeIs('orders') ? 'active' : '' }}">
                <i class="bi bi-cart3"></i>
                <span>Orders</span>
            </a>
            <a href="{{ route('pos') }}" class="menu-item {{ request()->routeIs('pos') ? 'active' : '' }}">
                <i class="bi bi-cash-coin"></i>
                <span>POS</span>
                <span class="badge-new">New</span>
            </a>
            <a href="#" class="menu-item">
                <i class="bi bi-people"></i>
                <span>Customers</span>
            </a>

            <div class="menu-section-title">Settings</div>
            <a href="#" class="menu-item">
                <i class="bi bi-shop"></i>
                <span>Store Settings</span>
            </a>
            <a href="#" class="menu-item">
                <i class="bi bi-person-circle"></i>
                <span>My Profile</span>
            </a>
            <a href="#" class="menu-item">
                <i class="bi bi-gear"></i>
                <span>Settings</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="#" class="menu-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
                <span>Log out</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Header - Snippe Style -->
        <header class="top-header">
            <div class="top-header-left">
                <h1>@yield('page-title', 'Overview')</h1>
            </div>
            <div class="top-header-right">
                <div class="header-search">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Search...">
                </div>
                <button class="header-btn">
                    <i class="bi bi-bell"></i>
                    <span class="header-badge">3</span>
                </button>
                <button class="header-btn">
                    <i class="bi bi-question-circle"></i>
                </button>
                <div class="header-user">
                    <div class="header-avatar">
                        {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                    </div>
                    <span class="header-username">{{ Auth::user()->email ?? Auth::user()->phone ?? 'User' }}</span>
                    <i class="bi bi-chevron-down small ms-2"></i>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <div class="content-wrapper">
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
