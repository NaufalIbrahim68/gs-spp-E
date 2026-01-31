@extends('layouts.front')
@section('title', 'Checkout')
@section('content')
    <div class="page-title light-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Checkout</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('front.index') }}">Home</a></li>
                    <li class="current">Checkout</li>
                </ol>
            </nav>
        </div>
    </div>
    <section id="checkout" class="checkout section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row">
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <div class="col-lg-7">
                    <div class="checkout-container" data-aos="fade-up">
                        <form class="" action="{{ route('front.prosesCheckout') }}" method="POST">
                            @csrf

                            <div class="checkout-section" id="customer-info">
                                <div class="section-header">
                                    <div class="section-number">1</div>
                                    <h3>Informasi Customer</h3>
                                </div>
                                <div class="section-content">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label for="first-name">Nama Lengkap</label>
                                            <input
                                                class="form-control form-control-lg @error('customer_name') is-invalid @enderror"
                                                id="customer_name" name="customer_name" type="text"
                                                value="{{ auth()->user()->name }}" required>
                                            <p class="text-danger">{{ $errors->first('customer_name') }}</p>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input class="form-control form-control-lg @error('email') is-invalid @enderror"
                                            name="email" type="email"value="{{ auth()->user()->email }}" readonly
                                            required>
                                        <p class="text-danger">{{ $errors->first('email') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">No Telp</label>
                                        <input
                                            class="form-control form-control-lg @error('customer_phone') is-invalid @enderror"
                                            name="customer_phone" type="text"
                                            value="{{ auth()->user()->customer->phone_number }}" required>
                                        <p class="text-danger">{{ $errors->first('customer_phone') }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="checkout-section" id="shipping-address">
                                <div class="section-header">
                                    <div class="section-number">2</div>
                                    <h3>Informasi Pengiriman</h3>
                                </div>
                                <div class="section-content">
                                    <div class="form-group">
                                        <label for="address">Alamat Lengkap</label>
                                        <input
                                            class="form-control form-control-lg @error('customer_address') is-invalid @enderror"
                                            name="customer_address" type="text"placeholder="Masukan alamat lengkap anda"
                                            required>
                                        <p class="text-danger">{{ $errors->first('customer_address') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-small text-uppercase" for="province_id">Provinsi</label>
                                        <select name="province_id" id="province_id"
                                            class="form-control @error('province_id') is-invalid @enderror">
                                            <option disabled {{ $provinces->count() > 1 ? 'selected' : '' }}>Pilih Provinsi</option>
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->id }}" {{ $provinces->count() == 1 ? 'selected' : '' }}>{{ $province->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label class="text-small text-uppercase" for="city_id">Kabupaten / Kota</label>
                                            <select name="city_id" id="city_id"
                                                class="form-control @error('city_id') is-invalid @enderror">
                                                <option disabled selected>Pilih Kabupaten / Kota</option>

                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label class="text-small text-uppercase" for="district_id">Kecamatan</label>
                                            <select name="district_id" id="district_id"
                                                class="form-control @error('district_id') is-invalid @enderror">
                                                <option disabled selected>Pilih Kecamatan</option>

                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="checkout-section" id="shipping-method">
                                <div class="section-header">
                                    <div class="section-number">3</div>
                                    <h3>Metode Pengiriman</h3>
                                </div>
                                <div class="section-content">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="shipping_method" id="shipping_regular" value="regular" required checked>
                                        <label class="form-check-label" for="shipping_regular">
                                            <strong>Regular</strong> <br>
                                            <span class="text-muted text-small">Estimasi 2-3 Hari</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="shipping_method" id="shipping_express" value="express">
                                        <label class="form-check-label" for="shipping_express">
                                            <strong>Express</strong> <br>
                                            <span class="text-muted text-small">Estimasi 1 Hari (Next Day)</span>
                                        </label>
                                    </div>
                                    <div class="mt-3">
                                        <small class="text-info"><i class="bi bi-info-circle"></i> Biaya ongkir akan dihitung otomatis berdasarkan Kota Tujuan & Layanan.</small>
                                    </div>
                                </div>
                            </div>

                            <div class="checkout-section" id="order-review">
                                <div class="section-header">
                                    <div class="section-number">4</div>
                                    <h3>Review &amp; Place Order</h3>
                                </div>
                                <div class="section-content">


                                    <div class="place-order-container">
                                        <button type="submit" class="btn btn-primary place-order-btn">
                                            <span class="btn-text">Place Order</span>
                                            <span class="btn-price">Rp{{ number_format($subtotal) }}</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </form>


                    </div>
                </div>

                <div class="col-lg-5">
                    <!-- Order Summary -->
                    <div class="order-summary" data-aos="fade-left" data-aos-delay="200">
                        <div class="order-summary-header">
                            <h3>Pesanan Anda</h3>
                        </div>

                        <div class="order-summary-content">
                            <div class="order-items">

                                @foreach ($carts as $cart)
                                    <div class="order-item">
                                        <div class="order-item-image">
                                            <img src="{{ asset('asset/produk/' . $cart['product_image']) }}" alt="Product"
                                                class="img-fluid">
                                        </div>
                                        <div class="order-item-details">
                                            <h4>{{ $cart['product_name'] }}</h4>
                                            <div class="order-item-price">
                                                <span class="quantity">{{ $cart['qty'] }}x</span>
                                                <span class="price">Rp
                                                    {{ number_format($cart['qty'] * $cart['product_price']) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="order-totals">
                                <div class="order-subtotal d-flex justify-content-between">
                                    <span>Total Subtotal</span>
                                    <span>Rp{{ number_format($subtotal) }}</span>
                                </div>
                                <div class="order-subtotal d-flex justify-content-between mt-2">
                                    <span>Biaya Pengiriman</span>
                                    <span id="shipping-cost-display">Rp0</span>
                                </div>
                                <hr>
                                <div class="order-subtotal d-flex justify-content-between">
                                    <strong class="text-uppercase">Total Bayar</strong>
                                    <strong id="grand-total-display" class="text-primary">Rp{{ number_format($subtotal) }}</strong>
                                </div>
                            </div>

                            <div class="secure-checkout">
                                <div class="secure-checkout-header">

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

    <script>
        $('#province_id').on('change', function() { // Changed from click to change

            $.ajax({
                url: "{{ url('api/city') }}",
                type: "GET",
                data: {
                    province_id: $(this).val()
                },
                success: function(html) {
                    $('#city_id').empty();
                    $('#city_id').append('<option selected disable>Pilih Kabupaten / Kota</option>')
                    $.each(html.data, function(key, item) {
                        $('#city_id').append(`<option value="` + item.id + `">` + item.type +
                            ' ' + item.name + `</option>`)
                    });
                }
            });

        });

        $('#city_id').on('change', function() {

            // Load Districts
            $.ajax({
                url: "{{ url('api/district') }}",
                type: "GET",
                data: {
                    city_id: $(this).val()
                },
                success: function(html) {
                    $('#district_id').empty();
                    $('#district_id').append('<option selected disable>Pilih Kecamatan</option>')
                    $.each(html.data, function(key, item) {
                        $('#district_id').append(`<option value="` + item.id + `">` + item
                            .name + `</option>`)
                    });
                }
            });
            
            // Calculate Shipping
            calculateShipping();
        });

        // Shipping Calculation Logic (Simulation)
        function calculateShipping() {
            let cityText = $('#city_id option:selected').text().toLowerCase();
            let method = $('input[name="shipping_method"]:checked').val();
            let cost = 0;
            let subtotal = {{ $subtotal }};

            // Needs to check if city is selected (not the placeholder)
            if (cityText.includes('pilih')) {
                $('#shipping-cost-display').text('Pilih Kota');
                // Reset to subtotal
                $('#grand-total-display').text('Rp' + new Intl.NumberFormat('id-ID').format(subtotal));
                $('.btn-price').text('Rp' + new Intl.NumberFormat('id-ID').format(subtotal));
                return;
            }

            if (cityText.includes('cilacap')) {
                cost = (method === 'express') ? 20000 : 10000;
            } else if (cityText.includes('purwokerto') || cityText.includes('banyumas')) {
                cost = (method === 'express') ? 30000 : 20000;
            } else if (cityText.includes('purbalingga')) {
                cost = (method === 'express') ? 40000 : 30000;
            } else {
                 // Default fallback
                 cost = (method === 'express') ? 50000 : 25000;
            }
            
            // Format Currency
            const formatter = new Intl.NumberFormat('id-ID');
            
            // Update UI
            $('#shipping-cost-display').text('Rp' + formatter.format(cost));
            
            let total = subtotal + cost;
            $('#grand-total-display').text('Rp' + formatter.format(total));
             
            // Update button text
             $('.btn-price').text('Rp' + formatter.format(total));
        }

        // Listeners
        $('#city_id').on('change', calculateShipping);
        $('input[name="shipping_method"]').on('change', calculateShipping);

        // Auto-load cities if province is pre-selected
        $(document).ready(function() {
            if ($('#province_id').val()) {
                $('#province_id').trigger('change');
            }
        });
    </script>

@endsection
