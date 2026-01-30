@extends('layouts.admin')

@section('title','Dashboard Admin')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
        <p class="text-muted">Selamat datang, {{ auth()->user()->name }}</p>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard </li>
        </ol>
      </div>
    </div>
  </div>
</div>

<section class="content">
  <div class="container-fluid">
    
    {{-- Main Statistics Cards --}}
    <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3 shadow-sm" style="border-left: 4px solid #17a2b8;">
          <span class="info-box-icon elevation-1" style="background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);"><i class="fas fa-box nav-icon"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Produk</span>
            <span class="info-box-number">{{ $product }}</span>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3 shadow-sm" style="border-left: 4px solid #ffc107;">
          <span class="info-box-icon elevation-1" style="background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);"><i class="fas fa-truck"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Perlu Dikirim</span>
            <span class="info-box-number">{{ $order }}</span>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3 shadow-sm" style="border-left: 4px solid #28a745;">
          <span class="info-box-icon elevation-1" style="background: linear-gradient(135deg, #28a745 0%, #218838 100%);"><i class="fas fa-wallet"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Pendapatan</span>
            <span class="info-box-number" style="font-size: 18px;">Rp {{ number_format($income) }}</span>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3 shadow-sm" style="border-left: 4px solid #dc3545;">
          <span class="info-box-icon elevation-1" style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);"><i class="fas fa-users"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Pelanggan Baru (H-7)</span>
            <span class="info-box-number">{{ $customer }}</span>
          </div>
        </div>
      </div>
    </div>

    {{-- Additional Stats --}}
    <div class="row">
      <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
          <div class="inner">
            <h3>{{ $totalOrders }}</h3>
            <p>Total Pesanan</p>
          </div>
          <div class="icon">
            <i class="fas fa-shopping-cart"></i>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{ $pendingPayments }}</h3>
            <p>Menunggu Konfirmasi</p>
          </div>
          <div class="icon">
            <i class="fas fa-hourglass-half"></i>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $totalCustomers }}</h3>
            <p>Total Pelanggan</p>
          </div>
          <div class="icon">
            <i class="fas fa-user-friends"></i>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ $completedOrders }}</h3>
            <p>Pesanan Selesai</p>
          </div>
          <div class="icon">
            <i class="fas fa-check-circle"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      {{-- Recent Orders --}}
      <div class="col-lg-8">
        <div class="card shadow-sm">
          <div class="card-header bg-gradient-primary">
            <h3 class="card-title text-white"><i class="fas fa-list mr-2"></i>Pesanan Terbaru</h3>
          </div>
          <div class="card-body p-0">
            <table class="table table-hover mb-0">
              <thead>
                <tr>
                  <th>Invoice</th>
                  <th>Pelanggan</th>
                  <th>Subtotal</th>
                  <th>Status</th>
                  <th>Tanggal</th>
                </tr>
              </thead>
              <tbody>
                @forelse($recentOrders as $order)
                <tr>
                  <td><a href="{{ route('admin.orders.detail', $order->invoice) }}" class="text-primary font-weight-bold">{{ $order->invoice }}</a></td>
                  <td>{{ $order->customer_name }}</td>
                  <td>Rp {{ number_format($order->subtotal) }}</td>
                  <td>{!! $order->status_label !!}</td>
                  <td>{{ $order->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                  <td colspan="5" class="text-center text-muted py-4">Belum ada pesanan</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          <div class="card-footer">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-primary">Lihat Semua Pesanan <i class="fas fa-arrow-right ml-1"></i></a>
          </div>
        </div>
      </div>

      {{-- Quick Actions --}}
      <div class="col-lg-4">
        <div class="card shadow-sm">
          <div class="card-header bg-gradient-info">
            <h3 class="card-title text-white"><i class="fas fa-bolt mr-2"></i>Aksi Cepat</h3>
          </div>
          <div class="card-body">
            <div class="d-grid gap-2">
              <a href="{{ route('admin.product.create') }}" class="btn btn-outline-primary btn-block mb-2">
                <i class="fas fa-plus-circle mr-2"></i>Tambah Produk Baru
              </a>
              <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-success btn-block mb-2">
                <i class="fas fa-list-alt mr-2"></i>Kelola Pesanan
              </a>
              <a href="{{ route('admin.category.index') }}" class="btn btn-outline-info btn-block mb-2">
                <i class="fas fa-tags mr-2"></i>Kelola Kategori
              </a>
              <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-warning btn-block mb-2">
                <i class="fas fa-users-cog mr-2"></i>Kelola Pelanggan
              </a>
              <a href="{{ route('admin.report.index') }}" class="btn btn-outline-secondary btn-block">
                <i class="fas fa-chart-bar mr-2"></i>Lihat Laporan
              </a>
            </div>
          </div>
        </div>

        {{-- Revenue Trend --}}
        <div class="card shadow-sm mt-3">
          <div class="card-header bg-gradient-success">
            <h3 class="card-title text-white"><i class="fas fa-chart-line mr-2"></i>Tren Pendapatan (6 Bulan)</h3>
          </div>
          <div class="card-body">
            <canvas id="revenueChart" height="200"></canvas>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
  // Revenue Chart
  const ctx = document.getElementById('revenueChart').getContext('2d');
  const revenueChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: {!! json_encode(array_column($monthlyRevenue, 'month')) !!},
      datasets: [{
        label: 'Pendapatan (Rp)',
        data: {!! json_encode(array_column($monthlyRevenue, 'revenue')) !!},
        backgroundColor: 'rgba(40, 167, 69, 0.2)',
        borderColor: 'rgba(40, 167, 69, 1)',
        borderWidth: 2,
        fill: true,
        tension: 0.4
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: function(value) {
              return 'Rp ' + value.toLocaleString('id-ID');
            }
          }
        }
      }
    }
  });
</script>
@endsection
