 <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);">

    <div class="sidebar">
      <!-- User Panel -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="border-bottom: 1px solid rgba(255,255,255,0.1);">
        <div class="image">
          <div class="rounded-circle bg-gradient-warning d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
            <i class="fas fa-user-shield text-white"></i>
          </div>
        </div>
        <div class="info">
          <a href="#" class="d-block text-white font-weight-bold">{{ auth()->user()->name }}</a>
          <small class="text-warning"><i class="fas fa-circle" style="font-size: 8px;"></i> Online</small>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="{{ route('admin.dashboard.index') }}" class="nav-link {{Request::path()==='admin/dashboard'?'active':''}}">
              <i class="nav-icon fas fa-tachometer-alt text-info"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-header" style="color: rgba(255,255,255,0.5); font-weight: 600; margin-top: 10px;">MASTER DATA</li>

          <li class="nav-item">
            <a href="{{ route('admin.category.index') }}" class="nav-link {{Request::path()==='admin/category'?'active':''}}">
              <i class="nav-icon fas fa-tags text-primary"></i>
              <p>Kategori</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.product.index') }}" class="nav-link {{Request::path()==='admin/product'?'active':''}}">
              <i class="nav-icon fas fa-box text-warning"></i>
              <p>Produk</p>
            </a>
          </li>

          <li class="nav-header" style="color: rgba(255,255,255,0.5); font-weight: 600; margin-top: 10px;">TRANSAKSI</li>

          <li class="nav-item">
            <a href="{{route('admin.orders.index')}}" class="nav-link {{Request::path()==='admin/orders'?'active':''}}">
              <i class="nav-icon fas fa-shopping-cart text-success"></i>
              <p>
                Pesanan
                @if($pendingOrders ?? 0 > 0)
                <span class="badge badge-danger right">{{ $pendingOrders }}</span>
                @endif
              </p>
            </a>
          </li>

          <li class="nav-header" style="color: rgba(255,255,255,0.5); font-weight: 600; margin-top: 10px;">MANAJEMEN USER</li>

          <li class="nav-item">
            <a href="{{route('admin.customers.index')}}" class="nav-link {{Request::path()==='admin/customers'?'active':''}}">
              <i class="nav-icon fas fa-users text-info"></i>
              <p>Pelanggan</p>
            </a>
          </li>

          <li class="nav-header" style="color: rgba(255,255,255,0.5); font-weight: 600; margin-top: 10px;">LAPORAN</li>

          <li class="nav-item">
            <a href="{{route('admin.report.index')}}" class="nav-link {{Request::path()==='admin/laporan'?'active':''}}">
              <i class="nav-icon fas fa-chart-bar text-danger"></i>
              <p>Laporan</p>
            </a>
          </li>

        </ul>
      </nav>

    </div>
  </aside>
