@extends('layouts.front')
@section('title', 'Payment')
@section('content')
    <div class="page-title light-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Konfirmasi Pembayaran</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('customer.dashboard') }}">Dashboard</a></li>
                    <li class="current">Konfirmasi Pembayaran</li>
                </ol>
            </nav>
        </div>
    </div>

    <section id="checkout" class="checkout section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="checkout-container" data-aos="fade-up">
                        <form action="{{ route('customer.payment_store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="checkout-section" id="customer-info">
                                <div class="section-header">
                                    <h3>Konfirmasi Pembayaran</h3>
                                </div>
                                <div class="section-content">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label for="">Invoice</label>
                                            <input type="text" readonly name="invoice" class="form-control"
                                                value="{{ request()->invoice }}" required>
                                            <p class="text-danger">{{ $errors->first('invoice') }}</p>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label for="">Nama Pengirim</label>
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Masukan nama pengirim" value="{{ old('name') }}" required>
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Transfer Ke</label>
                                        <select name="transfer_to" id="transfer_to" class="form-control" required>
                                            <option selected disabled>Pilih Tujuan Transfer</option>
                                            <option value="BCA - 198 241 654">BCA - 198 241 654 : GOLD-COMMERCE</option>
                                            <option value="BRI - 251 263 625">BRI - 251 263 625 : GOLD-COMMERCE</option>
                                        </select>
                                        <p class="text-danger">{{ $errors->first('transfer_to') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Jumlah Transfer</label>
                                        <div class="alert alert-info">
                                            <strong>Total Tagihan: Rp{{ number_format($order->subtotal + $order->shipping_cost) }}</strong>
                                        </div>
                                        <input type="number" name="amount" class="form-control"
                                            placeholder="Masukan jumlah transfer" value="{{ old('amount') ?? ($order->subtotal + $order->shipping_cost) }}" readonly>
                                        <small class="text-muted">Nominal transfer harus sesuai dengan total tagihan.</small>
                                        <p class="text-danger">{{ $errors->first('amount') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tanggal Transfer</label>
                                        <input type="date" placeholder="dd-mm-yyyy" name="transfer_date"
                                            class="form-control" id="transfer_date" value="{{ old('transfer_date') }}">
                                        <p class="text-danger">{{ $errors->first('transfer_date') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Bukti Transfer</label>
                                        <input type="file" name="proof" class="form-control" accept="image/*"
                                            placeholder="Masukan jumlah transfer" value="{{ old('proof') }}">
                                        <p class="text-danger">{{ $errors->first('proof') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-dark btn-block">Konfirmasi Pesanan</button>
                                    </div>
                                </div>
                            </div>


                        </form>


                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
