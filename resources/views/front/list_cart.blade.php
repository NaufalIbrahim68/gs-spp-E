@extends('layouts.front')
@section('title', 'Keranjang Belanja')
@section('content')
    <div class="page-title light-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Keranjang</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('front.index') }}">Home</a></li>
                    <li class="current">Keranjang</li>
                </ol>
            </nav>
        </div>
    </div>


    <section id="cart" class="cart section">


        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <form action="{{ route('front.update_cart') }}" method="post">
                @csrf
                @method('PUT')
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="row g-4">
                    <div class="col-lg-9" data-aos="fade-up" data-aos-delay="200">
                        <div class="cart-items">
                            <div class="cart-header d-none d-lg-block">
                                <div class="row align-items-center gy-4">
                                    <div class="col-lg-6">
                                        <h5>Produk</h5>
                                    </div>
                                    <div class="col-lg-2 text-center">
                                        <h5>Harga</h5>
                                    </div>
                                    <div class="col-lg-2 text-center">
                                        <h5>Qty</h5>
                                    </div>
                                    <div class="col-lg-2 text-center">
                                        <h5>Total</h5>
                                    </div>
                                </div>
                            </div>

                            @forelse ($carts as $item)
                                <div class="cart-item" data-aos="fade-up" data-aos-delay="100">
                                    <div class="row align-items-center gy-4">
                                        <div class="col-lg-6 col-12 mb-3 mb-lg-0">
                                            <div class="product-info d-flex align-items-center">
                                                <div class="product-image">
                                                    <img src="{{ asset('asset/produk/' . $item['product_image']) }}"
                                                        alt="{{ $item['product_name'] }}" alt="Product" class="img-fluid"
                                                        loading="lazy">
                                                </div>
                                                <div class="product-details">
                                                    <h6 class="product-title">{{ $item['product_name'] }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-2 text-center">
                                            <div class="price-tag">
                                                <span
                                                    class="current-price">Rp{{ number_format($item['product_price']) }}</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-2 text-center">
                                            <div class="quantity-selector">
                                                <span class="quantity-btn decrease">
                                                    <i class="bi bi-dash"></i>
                                                </span>
                                                <input type="number" class="quantity-input" value="{{ $item['qty'] }}"
                                                    name="qty[]" max="10">
                                                <span class="quantity-btn increase">
                                                    <i class="bi bi-plus"></i>
                                                </span>

                                                <input type="hidden" value="{{ $item['product_id'] }}" name="product_id[]">

                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-2 text-center mt-3 mt-lg-0">
                                            <div class="item-total">
                                                <span>Rp{{ number_format($item['product_price'] * $item['qty']) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse



                            <div class="cart-actions">
                                <div class="row g-3">

                                    <div class="col-lg-6 col-md-6 text-md-end">
                                        <button class="btn btn-outline-accent me-2">
                                            <i class="bi bi-arrow-clockwise"></i> Update
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3" data-aos="fade-up" data-aos-delay="300">
                        <div class="cart-summary">
                            <h4 class="summary-title">Ringkasan</h4>

                            <div class="summary-item">
                                <span class="summary-label">Subtotal</span>
                                <span class="summary-value">Rp{{ number_format($subtotal) }}</span>
                            </div>

                            <div class="summary-total">
                                <span class="summary-label">Total</span>
                                <span class="summary-value">Rp{{ number_format($subtotal) }}</span>
                            </div>

                            <div class="continue-shopping">
                                @if ($carts != null)
                                    <a href="{{ route('front.checkout') }}" class="btn btn-accent w-100">
                                        Checkout Sekarang <i class="bi bi-arrow-right"></i>
                                    </a>
                                @endif

                            </div>

                        </div>
                    </div>
                </div>
            </form>

        </div>

    </section>
@endsection
