 <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="{{ route('admin.dashboard.index') }}" class="brand-link text-center">
      <span class="brand-text font-weight-light "><h4>Admin</h4></span>
    </a>


    <div class="sidebar">

      <nav class="mt-3">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="{{ route('admin.dashboard.index') }}" class="nav-link {{Request::path()==='admin/dashboard'?'active':''}} ">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.category.index') }}" class="nav-link {{Request::path()==='admin/category'?'active':''}} ">
              <i class="fas fa-archive  nav-icon"></i>
              <p>
                Kategori
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.product.index') }}" class="nav-link {{Request::path()==='admin/product'?'active':''}} ">
              <i class="fas fa-clock  nav-icon "></i>
              <p>
                Produk
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('admin.orders.index')}}" class="nav-link {{Request::path()==='admin/orders'?'active':''}} ">
              <i class="fas fa-box  nav-icon "></i>
              <p>
                Pesanan
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('admin.customers.index')}}" class="nav-link {{Request::path()==='admin/customers'?'active':''}} ">
              <i class="fas fa-users  nav-icon "></i>
              <p>
                Pelanggan
              </p>
            </a>
          </li>

           <li class="nav-item">
            <a href="{{route('admin.report.index')}}" class="nav-link {{Request::path()==='admin/laporan'?'active':''}} ">
              <i class="fas fa-download  nav-icon "></i>
              <p>
                Laporan
              </p>
            </a>
          </li>




        </ul>
      </nav>

    </div>
  </aside>
