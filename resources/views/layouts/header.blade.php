<!-- Header - Clean Minimal -->
<header class="main-header">
    <div class="header-left">
        <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
    </div>
    <div class="header-right">
        <button class="header-icon-btn">
            <i data-lucide="bell"></i>
            <span class="notification-dot"></span>
        </button>
        <div class="user-dropdown">
            <div class="user-avatar">{{ substr(Auth::user()->name ?? 'U', 0, 1) }}</div>
            <div class="user-info">
                <span class="user-name">{{ Auth::user()->name ?? 'User' }}</span>
                <span class="user-role">Administrator</span>
            </div>
            <i data-lucide="chevron-down" class="dropdown-icon"></i>
        </div>
    </div>
</header>

<style>
.main-header {
    height: 64px;
    background: #ffffff;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 32px;
    position: sticky;
    top: 0;
    z-index: 100;
}

.header-left .page-title {
    font-size: 20px;
    font-weight: 600;
    color: #111827;
    margin: 0;
}

.header-right {
    display: flex;
    align-items: center;
    gap: 16px;
}

.header-icon-btn {
    width: 40px;
    height: 40px;
    border: none;
    background: transparent;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    position: relative;
    transition: all 0.2s;
}

.header-icon-btn:hover {
    background: #f3f4f6;
}

.header-icon-btn i {
    width: 20px;
    height: 20px;
    color: #6b7280;
}

.notification-dot {
    position: absolute;
    top: 8px;
    right: 8px;
    width: 8px;
    height: 8px;
    background: #dc2626;
    border-radius: 50%;
    border: 2px solid white;
}

.user-dropdown {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 6px 12px 6px 6px;
    border-radius: 24px;
    cursor: pointer;
    transition: all 0.2s;
}

.user-dropdown:hover {
    background: #f3f4f6;
}

.user-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: linear-gradient(135deg, #dc2626, #b91c1c);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 14px;
}

.user-info {
    display: flex;
    flex-direction: column;
    line-height: 1.2;
}

.user-name {
    font-size: 13px;
    font-weight: 600;
    color: #111827;
}

.user-role {
    font-size: 11px;
    color: #9ca3af;
}

.dropdown-icon {
    width: 16px;
    height: 16px;
    color: #9ca3af;
}
</style>
