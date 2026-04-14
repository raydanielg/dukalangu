<!-- Sidebar - Clean White Style -->
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-logo">
            <img src="{{ asset('Salama logo.png') }}" alt="{{ config('app.name') }}">
        </div>
        <div class="brand-text">
            <span class="brand-name">{{ config('app.name') }}</span>
            <span class="brand-tagline">Admin Panel</span>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section">
            <div class="nav-section-title">Main</div>
            <a href="{{ route('home') }}" class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                <i data-lucide="activity"></i>
                <span>Overview</span>
            </a>
            <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i data-lucide="layout-grid"></i>
                <span>Dashboard</span>
            </a>
        </div>

        <div class="nav-section">
            <span class="nav-label">My Store</span>
            <a href="{{ route('store.builder') }}" class="nav-item {{ request()->routeIs('store.*') ? 'active' : '' }}">
                <i data-lucide="store"></i>
                <span>Create Store</span>
                <span class="badge-new">New</span>
            </a>
            <a href="{{ route('products.index') }}" class="nav-item {{ request()->routeIs('products.*') ? 'active' : '' }}">
                <i data-lucide="package"></i>
                <span>My Products</span>
            </a>
            <a href="{{ route('orders') }}" class="nav-item {{ request()->routeIs('orders') ? 'active' : '' }}">
                <i data-lucide="receipt"></i>
                <span>Orders</span>
            </a>
            <a href="{{ route('pos') }}" class="nav-item {{ request()->routeIs('pos') ? 'active' : '' }}">
                <i data-lucide="shopping-cart"></i>
                <span>Quick Sell</span>
            </a>
            <a href="#" class="nav-item">
                <i data-lucide="users"></i>
                <span>Customers</span>
            </a>
        </div>

        <div class="nav-section">
            <span class="nav-label">Inventory</span>
            <a href="{{ route('products.in-stock') }}" class="nav-item">
                <i data-lucide="check-circle-2"></i>
                <span>In Stock</span>
            </a>
            <a href="{{ route('products.out-of-stock') }}" class="nav-item">
                <i data-lucide="alert-circle"></i>
                <span>Out of Stock</span>
            </a>
            <a href="{{ route('categories.index') }}" class="nav-item {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                <i data-lucide="folder-tree"></i>
                <span>Categories</span>
            </a>
        </div>

        <div class="nav-section">
            <span class="nav-label">Profile</span>
            <a href="{{ route('profile.edit') }}" class="nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                <i data-lucide="user"></i>
                <span>My Profile</span>
            </a>
            <a href="{{ route('profile.store') }}" class="nav-item {{ request()->routeIs('profile.store') ? 'active' : '' }}">
                <i data-lucide="store"></i>
                <span>Store Settings</span>
            </a>
            <a href="#" class="nav-item">
                <i data-lucide="settings"></i>
                <span>Settings</span>
            </a>
        </div>
    </nav>

    <div class="sidebar-footer">
        <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i data-lucide="log-out"></i>
            <span>Sign Out</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</aside>

<style>
.sidebar {
    width: 240px;
    height: 100vh;
    background: #ffffff;
    border-right: 1px solid #e5e7eb;
    position: fixed;
    left: 0;
    top: 0;
    z-index: 1000;
    display: flex;
    flex-direction: column;
    overflow-y: auto;
}

.sidebar-brand {
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 12px;
    border-bottom: 1px solid #f3f4f6;
}

.brand-logo img {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    object-fit: contain;
}

.brand-text {
    display: flex;
    flex-direction: column;
}

.brand-name {
    font-size: 16px;
    font-weight: 700;
    color: #111827;
}

.brand-tagline {
    font-size: 11px;
    color: #9ca3af;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.sidebar-nav {
    flex: 1;
    padding: 16px 12px;
    overflow-y: auto;
}

.nav-section {
    margin-bottom: 24px;
}

.nav-label {
    display: block;
    font-size: 10px;
    font-weight: 600;
    color: #9ca3af;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 0 12px 8px;
    margin-bottom: 4px;
}

.nav-item {
    display: flex;
    align-items: center;
    padding: 10px 12px;
    margin: 2px 0;
    color: #6b7280;
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.2s ease;
    font-size: 14px;
    position: relative;
}

.nav-item i {
    width: 18px;
    height: 18px;
    margin-right: 12px;
    opacity: 0.7;
}

.nav-item:hover {
    background: #f3f4f6;
    color: #111827;
    text-decoration: none;
}

.nav-item.active {
    background: #fef2f2;
    color: #dc2626;
}

.nav-item.active i {
    opacity: 1;
}

.badge-new {
    margin-left: auto;
    background: #dc2626;
    color: white;
    font-size: 10px;
    padding: 2px 6px;
    border-radius: 4px;
    font-weight: 500;
}

.has-submenu .submenu-icon {
    width: 14px;
    height: 14px;
    margin-left: auto;
    margin-right: 0;
    transition: transform 0.2s;
}

.has-submenu.open .submenu-icon {
    transform: rotate(180deg);
}

.submenu {
    display: none;
    padding-left: 42px;
}

.submenu.show {
    display: block;
    animation: slideDown 0.2s ease;
}

.submenu-item {
    display: block;
    padding: 8px 12px;
    color: #6b7280;
    text-decoration: none;
    font-size: 13px;
    border-radius: 6px;
    margin: 2px 0;
}

.submenu-item:hover {
    background: #f3f4f6;
    color: #111827;
    text-decoration: none;
}

.sidebar-footer {
    padding: 16px;
    border-top: 1px solid #f3f4f6;
}

.logout-btn {
    display: flex;
    align-items: center;
    padding: 10px 12px;
    color: #dc2626;
    text-decoration: none;
    border-radius: 8px;
    font-size: 14px;
    transition: all 0.2s;
}

.logout-btn i {
    width: 18px;
    height: 18px;
    margin-right: 12px;
}

.logout-btn:hover {
    background: #fef2f2;
    text-decoration: none;
}

@keyframes slideDown {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<script>
function toggleSubmenu(id) {
    const submenu = document.getElementById(id);
    const trigger = event.currentTarget;
    submenu.classList.toggle('show');
    trigger.classList.toggle('open');
}
</script>
