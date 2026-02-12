<!-- Customer Sidebar Component -->
<div class="col-lg-3">
    <div class="profile-menu collapse d-lg-block" id="profileMenu">
        <!-- User Info -->
        <div class="user-info" data-aos="fade-right">
            <h4>{{ auth()->user()->name }}</h4>
            <p class="text-muted">{{ auth()->user()->email }}</p>
        </div>

        <!-- Navigation Menu -->
        <nav class="menu-nav">
            <ul class="nav flex-column">
                <li class="nav-item">
                    
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}" href="{{ route('customer.dashboard') }}">
                        <i class="bi bi-box-seam"></i>
                        <span>Order Saya</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('customer.profile') ? 'active' : '' }}" href="{{ route('customer.profile') }}">
                        <i class="bi bi-person"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('customer.settings') ? 'active' : '' }}" href="{{ route('customer.settings') }}">
                        <i class="bi bi-gear"></i>
                        <span>Settings</span>
                    </a>
                </li>
            </ul>

            <div class="menu-footer">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a class="logout-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Log Out</span>
                </a>
            </div>
        </nav>
    </div>
</div>
<style>
    .profile-menu {
        position: -webkit-sticky;
        position: sticky;
        top: 100px; /* Adjust based on header height */
        z-index: 99;
    }
</style>
