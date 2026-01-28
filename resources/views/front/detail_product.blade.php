@extends('layouts.front')
@section('title')
    {{ $product->name }}
@endsection
@section('content')
    <div class="page-title light-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Product Details</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('front.index') }}">Home</a></li>
                    <li class="current">Product Details</li>
                </ol>
            </nav>
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success"> {{ session('success') }}</div>
    @endif

    <section id="product-details" class="product-details section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row">
                <!-- Product Images -->
                <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right" data-aos-delay="200">
                    <div class="product-images">
                        <div class="main-image-container mb-3">
                            <div class="image-zoom-container">
                                <img src="{{ asset('asset/produk/' . $product->image) }}" alt="Product Image"
                                    class="img-fluid main-image drift-zoom" id="main-product-image"
                                    data-zoom="{{ asset('asset/produk/' . $product->image) }}">
                            </div>
                        </div>

                        <div class="product-thumbnails">
                            <div class="swiper product-thumbnails-slider init-swiper">



                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                    <div class="product-info">
                        <div class="product-meta mb-2">
                            <span class="product-category">{{ $product->category->name }}</span>

                        </div>

                        <h1 class="product-title">{{ $product->name }}</h1>

                        <div class="product-price-container mb-4">
                            <span class="current-price">Rp {{ number_format($product->price) }}</span>
                        </div>

                        <form action="{{ route('front.cart') }}" method="post">
                            <!-- Quantity Selector -->
                            <div class="product-quantity mb-4">
                                <h6 class="option-title">Quantity:</h6>
                                <div class="quantity-selector">
                                    <span class="quantity-btn decrease">
                                        <i class="bi bi-dash"></i>
                                    </span>
                                    <input type="number" name="qty" class="quantity-input" value="1" min="1"
                                        max="24">
                                    <span class="quantity-btn increase">
                                        <i class="bi bi-plus"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="product-actions">

                                @csrf
                                <input type="hidden" value="{{ $product->id }}" name="product_id">
                                <button class="btn btn-primary add-to-cart-btn">
                                    <i class="bi bi-cart-plus"></i> Add to Cart
                                </button>

                            </div>
                        </form>


                    </div>
                </div>
            </div>

            <!-- Product Details Tabs -->
            <div class="row mt-5" data-aos="fade-up">
                <div class="col-12">
                    <div class="product-details-tabs">
                        <ul class="nav nav-tabs" id="productTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                    data-bs-target="#description" type="button" role="tab" aria-controls="description"
                                    aria-selected="true">Description</button>
                            </li>

                        </ul>
                        <div class="tab-content" id="productTabsContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel"
                                aria-labelledby="description-tab">
                                <div class="product-description">
                                    <ul class="list-unstyled small d-inline-block">
                                        <li class="px-3 py-2 mb-1 bg-white">
                                            <strong class="text-uppercase">Berat:</strong>
                                            <span class="ml-2 text-muted">{{ $product->weight }} gr</span>
                                        </li>
                                        <li class="px-3 py-2 mb-1 bg-white text-muted">
                                            <strong class="text-uppercase text-dark">Kategori:
                                            </strong><a class="reset-anchor ml-2"
                                                href="#">{{ $product->category->name }}</a>
                                        </li>

                                    </ul>
                                    {!! $product->description !!}
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
