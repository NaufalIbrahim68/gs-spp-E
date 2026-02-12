@extends('layouts.front')
@section('title', 'Home Page')
@section('content')
    <section class="ecommerce-hero-1 hero section" id="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 content-col" data-aos="fade-right" data-aos-delay="100">
                    <div class="content">
                        <span class="promo-badge">New Collection 2025</span>
                        <h1>Kilau Emas, Kemewahan Abadi</h1>
                        <p> Temukan koleksi eksklusif gelang, anting, dan perhiasan emas yang memancarkan keanggunan di setiap momen.</p>
                        <div class="hero-cta d-flex justify-content-center">
                            <a href="{{route('front.product')}}" class="btn btn-shop">Shop Now <i class="bi bi-arrow-right"></i></a>
                        </div>
                        <div class="hero-features d-flex justify-content-center">
                            <div class="feature-item">
                                <i class="bi bi-truck"></i>
                                <span>Free Shipping</span>
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-shield-check"></i>
                                <span>Secure Payment</span>
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-arrow-repeat"></i>
                                <span>Easy Returns</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 image-col" data-aos="fade-left" data-aos-delay="200">
                    <div class="hero-image">
                        <img src="{{asset('front/img/hero.jpg')}}" alt="Fashion Product" class="main-product"
                            loading="lazy">

                        <div class="discount-badge" data-aos="zoom-in" data-aos-delay="500">
                            <span class="percent">30%</span>
                            <span class="text">OFF</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="category-cards" class="category-cards section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="category-slider swiper init-swiper">
                <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "autoplay": {
                "delay": 5000,
                "disableOnInteraction": false
              },
              "grabCursor": true,
              "speed": 600,
              "slidesPerView": "auto",
              "spaceBetween": 20,
              "navigation": {
                "nextEl": ".swiper-button-next",
                "prevEl": ".swiper-button-prev"
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "spaceBetween": 15
                },
                "576": {
                  "slidesPerView": 3,
                  "spaceBetween": 15
                },
                "768": {
                  "slidesPerView": 4,
                  "spaceBetween": 20
                },
                "992": {
                  "slidesPerView": 5,
                  "spaceBetween": 20
                },
                "1200": {
                  "slidesPerView": 6,
                  "spaceBetween": 20
                }
              }
            }
          </script>

                <div class="swiper-wrapper">
                    @foreach ($products as $product)
                        <div class="swiper-slide">
                        <div class="category-card" data-aos="fade-up" data-aos-delay="100">
                            <div class="category-image">
                                <img src="{{ asset('asset/produk/' . $product->image) }}" alt="Category" class="img-fluid">
                            </div>
                            <h3 class="category-title">{{$product->category->name}}</h3>
                            <a href="{{route('front.product')}}" class="stretched-link"></a>
                        </div>
                    </div>
                    @endforeach

                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>

        </div>

    </section>


    <section id="best-sellers" class="best-sellers section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Best Sellers</h2>
            <p>Pilihan terbaik dari para pelanggan setia</p>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">
                @foreach ($products as $product)
                    <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset('asset/produk/' . $product->image) }}" class="img-fluid default-image"
                                    alt="Product" loading="lazy">
                                <img src="{{ asset('asset/produk/' . $product->image) }}" class="img-fluid hover-image"
                                    alt="Product hover" loading="lazy">
                                <div class="product-tags">
                                    <span class="badge bg-accent">New</span>
                                </div>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title"><a
                                        href="{{ url('produk/' . $product->slug) }}">{{ $product->name }}</a></h3>
                                <div class="product-price">
                                    <span class="current-price">Rp{{ number_format($product->price) }}</span>
                                </div>

                                <form action="{{ route('front.cart') }}" method="post">
                                    @csrf
                                    <input type="hidden" value="{{ $product->id }}" name="product_id">
                                    <input type="hidden" value="1" name="qty">
                                    <button class="btn btn-add-to-cart">
                                        <i class="bi bi-bag-plus me-2"></i>Add to Cart
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

    </section>
@endsection
