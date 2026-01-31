<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="border-bottom: 3px solid #ffc107;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a href="{{ route('admin.dashboard.index') }}" class="nav-link p-0">
          <img src="{{asset('front/img/logo_r.png')}}" alt="GS-SPP Logo" style="max-height: 55px; width: auto; margin-top: -5px;">
        </a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      <!-- Quick Stats -->
      <li class="nav-item d-none d-md-inline-block">
        <span class="nav-link">
          <small class="text-muted">Pesanan Hari Ini:</small>
          <span class="badge badge-warning ml-1">{{ \App\Models\Order::whereDate('created_at', today())->count() }}</span>
        </span>
      </li>

      <!-- Notifications Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          @if((\App\Models\Order::where('status', 1)->count()) > 0)
          <span class="badge badge-danger navbar-badge">{{ \App\Models\Order::where('status', 1)->count() }}</span>
          @endif
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">
            {{ \App\Models\Order::where('status', 1)->count() }} Pesanan Menunggu Konfirmasi
          </span>
          <div class="dropdown-divider"></div>
          <a href="{{ route('admin.orders.index') }}?status=1" class="dropdown-item">
            <i class="fas fa-hourglass-half mr-2"></i> Lihat Semua
          </a>
        </div>
      </li>

      <!-- User Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user-circle fa-lg"></i>
          <span class="d-none d-md-inline ml-1">{{ auth()->user()->name }}</span>
          <i class="fas fa-caret-down ml-1"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-item dropdown-header bg-gradient-primary text-white">
            <i class="fas fa-user-shield mr-2"></i>{{ auth()->user()->name }}
          </div>
          <div class="dropdown-divider"></div>
          <a href="{{ route('profile.edit') }}" class="dropdown-item">
            <i class="fas fa-user-cog mr-2"></i> Profil Saya
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('front.index') }}" class="dropdown-item">
            <i class="fas fa-home mr-2"></i> Halaman Depan
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      </li>

    </ul>
  </nav>
