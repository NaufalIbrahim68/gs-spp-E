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
                                    <a class="nav-link active" data-bs-toggle="tab" href="#orders">
                                        <i class="bi bi-box-seam"></i>
                                        <span>Order Saya</span>

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

@endsection
