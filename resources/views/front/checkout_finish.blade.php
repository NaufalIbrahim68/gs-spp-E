@extends('layouts.front')
@section('title', 'Checkout')
@section('content')
    <div class="page-title light-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Order Confirmation</h1>
            <nav class="breadcrumbs">
                <ol>
            <li><a href="index.html">Home</a></li>
                    <li class="current">Order Confirmation</li>
                </ol>
            </nav>
        </div>
    </div>

    <section id="order-confirmation" class="order-confirmation section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="order-confirmation-1">
                <div class="confirmation-header text-center" data-aos="fade-up">
                    <div class="success-icon mb-4">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <h2>Pesanan Selesai</h2>
                    <p class="lead">Silahkan untuk melakukan konfirmasi pembayaran atau klik <a
                            href="{{ url('/customer/payment?invoice=' . $order->invoice) }}">disini</a></p>
                    <div class="order-number mt-3 mb-4">
                        <span>Inv #</span>
                        <strong>{{ $order->invoice }}</strong>
                        <span class="mx-2">•</span>
                        <span>{{ $order->created_at }}</span>
                    </div>
                </div>


                <div class="order-summary mb-4" data-aos="fade-up" data-aos-delay="200">
                    <h4>Ringkasan Order</h4>
                    <div class="order-items mt-3">

                        @foreach ($order->orderDetail as $item)
                            <div class="item-row d-flex">
                                <div class="item-image">
                                    <img src="{{ asset('asset/produk/' . $item->product->image) }}" alt="Product"
                                        class="img-fluid" loading="lazy">
                                </div>
                                <div class="item-details">
                                    <h5>{{ $item->product->name }}</h5>
                                    <div class="quantity-price d-flex justify-content-between">
                                        <span>Qty: {{ $item->qty }}</span>
                                        <span class="price">Rp{{ number_format($item->price * $item->qty) }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="order-totals mt-4">
                        <div class="d-flex justify-content-between py-2 total-row">
                            <strong>Total</strong>
                            <strong>Rp{{ number_format($order->subtotal) }}</strong>
                        </div>
                    </div>
                </div>

                <div class="next-steps text-center p-4" data-aos="fade-up" data-aos-delay="250">

                    <div class="action-buttons">
                        <a href="{{ route('front.product') }}" class="btn btn-primary me-3 mb-2 mb-md-0">
                            <i class="bi bi-bag me-2"></i>Lanjut Belanja
                        </a>
                        <a href="{{ url('/customer/payment?invoice=' . $order->invoice) }}" class="btn btn-outline-primary">
                            <i class="bi bi-person me-2"></i>Konfirmasi pembayaran
                        </a>
                    </div>
                </div>

            </div>

        </div>

    </section>
@endsection
