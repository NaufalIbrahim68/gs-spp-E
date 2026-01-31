@extends('layouts.front')
@section('title', 'Dashboard')
@section('content')
    <div class="page-title light-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Account</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li class="current">Account</li>
                </ol>
            </nav>
        </div>
    </div>
    <section id="account" class="account section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <!-- Mobile Menu Toggle -->
            <div class="mobile-menu d-lg-none mb-4">
                <button class="mobile-menu-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#profileMenu">
                    <i class="bi bi-grid"></i>
                    <span>Menu</span>
                </button>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="row g-4">
                <!-- Profile Menu -->
                <div class="col-lg-3">
                    <div class="profile-menu collapse d-lg-block" id="profileMenu">
                        <!-- User Info -->
                        <div class="user-info" data-aos="fade-right">
                            <h4>{{ auth()->user()->name }}</h4>
                        </div>

                        <!-- Navigation Menu -->
                        <nav class="menu-nav">
                            <ul class="nav flex-column" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('customer.dashboard') }}">
                                        <i class="bi bi-speedometer2"></i>
                                        <span>Dashboard</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#orders">
                                        <i class="bi bi-box-seam"></i>
                                        <span>Order Saya</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('customer.profile') }}">
                                        <i class="bi bi-person"></i>
                                        <span>Profile</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('customer.settings') }}">
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
                                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Log Out</span>
                                </a>
                            </div>
                        </nav>
                    </div>
                </div>

                <!-- Content Area -->
                <div class="col-lg-9">
                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-md-4 mb-3" data-aos="fade-up" data-aos-delay="100">
                            <div class="stats-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                <div class="stats-icon">
                                    <i class="bi bi-cart-check"></i>
                                </div>
                                <div class="stats-content">
                                    <h3>{{ $totalOrders }}</h3>
                                    <p>Total Orders</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3" data-aos="fade-up" data-aos-delay="200">
                            <div class="stats-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                                <div class="stats-icon">
                                    <i class="bi bi-wallet2"></i>
                                </div>
                                <div class="stats-content">
                                    <h3>Rp {{ number_format($totalSpending) }}</h3>
                                    <p>Total Belanja</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3" data-aos="fade-up" data-aos-delay="300">
                            <div class="stats-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                                <div class="stats-icon">
                                    <i class="bi bi-check-circle"></i>
                                </div>
                                <div class="stats-content">
                                    <h3>{{ $completedOrders }}</h3>
                                    <p>Selesai</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-area">
                        <div class="tab-content">
                            <!-- Orders Tab -->
                            <div class="tab-pane fade show active" id="orders">
                                <div class="section-header" data-aos="fade-up">
                                    <h2>My Orders</h2>
                                </div>

                                <div class="orders-grid">
                                    <!-- Order Card 1 -->
                                    @foreach ($orders as $item)
                                        <div class="order-card" data-aos="fade-up" data-aos-delay="100">
                                            <div class="order-header">
                                                <div class="order-id">
                                                    <span class="label">Order ID:</span>
                                                    <span class="value">#{{ $item->invoice }}</span>
                                                </div>
                                                <div class="order-date"> <a href="{{ route('customer.detailOrder', $item->invoice) }}">Detail</a></div>
                                            </div>
                                            <div class="order-content">
                                                <div class="order-info">
                                                    <div class="info-row">
                                                        <span>Status</span>
                                                        <span class="status processing">{!! $item->status_label !!}</span>
                                                    </div>
                                                    <div class="info-row">
                                                        <span>Total</span>
                                                        <span class="price">Rp{{ number_format($item->subtotal) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="order-footer">


                                                <form action="{{ route('customer.order_accept') }}" method="POST"
                                                    onsubmit="return confirm('Sudah yakin barang nya sesuai?')">
                                                    @csrf

                                                    <input type="hidden" name="order_id" value="{{ $item->id }}">
                                                    @if ($item->status == 3 && $item->return_count == 0)
                                                        <button type="submit">Terima Barang</button>
                                                    @endif

                                                </form>
                                                @if ($item->status == 0)
                                                    <a href="{{ url('/customer/payment?invoice=' . $item->invoice) }}"
                                                       class="btn-details">Konfirmasi</a>
                                                @endif


                                            </div>


                                        </div>
                                    @endforeach


                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

@endsection

@section('js')
    <style>
        .stats-card {
            padding: 25px;
            border-radius: 15px;
            color: white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .stats-card .stats-icon {
            position: absolute;
            right: 20px;
            top: 20px;
            font-size: 50px;
            opacity: 0.3;
        }
        
        .stats-card .stats-content h3 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
            color: white;
        }
        
        .stats-card .stats-content p {
            font-size: 14px;
            margin: 0;
            opacity: 0.9;
            font-weight: 500;
        }
    </style>
@endsection
