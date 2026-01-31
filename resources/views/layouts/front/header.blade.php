<header id="header" class="header position-relative">

    <!-- Main Header -->
    <div class="main-header">
        <div class="container-fluid container-xl">
            <div class="d-flex py-3 align-items-center justify-content-between">

                <a href="{{ route('front.index') }}" >
                    <img src="{{asset('front/img/logo_r.png')}}" class="logo d-flex align-items-center" alt="Toko Emas Gombong-Safary" height="75px">                
                </a>


                <div class="header-actions d-flex align-items-center justify-content-end">

                    <!-- Mobile Search Toggle -->
                    <button class="header-action-btn mobile-search-toggle d-xl-none" type="button"
                        data-bs-toggle="collapse" data-bs-target="#mobileSearch" aria-expanded="false"
                        aria-controls="mobileSearch">
                        <i class="bi bi-search"></i>
                    </button>

                    <div class="dropdown account-dropdown">
                        <button class="header-action-btn" data-bs-toggle="dropdown">
                            <i class="bi bi-person"></i>
                        </button>
                        <div class="dropdown-menu">
                            <div class="dropdown-header">
                                <p class="mb-0">Akses Akun &amp; manage orders</p>
                            </div>
                            @if (auth()->check())
                                <div class="dropdown-body">
                                    <a class="dropdown-item d-flex align-items-center" href="{{route("customer.dashboard")}}">
                                        <i class="bi bi-bag-check me-2"></i>
                                        <span>Order</span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="{{route("customer.profile")}}">
                                        <i class="bi bi-person me-2"></i>
                                        <span>Profile</span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="{{route("customer.settings")}}">
                                        <i class="bi bi-gear me-2"></i>
                                        <span>Settings</span>
                                    </a>
                                    <form id="logout-form-header" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    <a class="dropdown-item d-flex align-items-center text-danger" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i>
                                        <span>Logout</span>
                                    </a>
                                </div>
                            @endif
                            @if (!auth()->check())
                                <div class="dropdown-footer">
                                    <a href="{{ route('login') }}" class="btn btn-primary w-100 mb-2">Sign In</a>
                                    <a href="{{ route('login') }}" class="btn btn-outline-primary w-100">Register</a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Cart -->
                    <a href="{{ route('front.cart_list') }}" class="header-action-btn">
                        <i class="bi bi-cart3"></i>
                        <span class="badge">{{ $carts }}</span>
                    </a>

                    <!-- Mobile Navigation Toggle -->
                    <i class="mobile-nav-toggle d-xl-none bi bi-list me-0"></i>

                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="header-nav">
        <div class="container-fluid container-xl">
            <div class="position-center">
                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li><a href="{{ route('front.index') }}" class="active">Home</a></li>
                        <li><a href="{{ route('front.product') }}">Product</a></li>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>


</header>
