@extends('layouts.front')
@section('title', 'Product')
@section('content')
    <div class="page-title light-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Produk</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('front.index') }}">Home</a></li>
                    <li class="current">Produk</li>
                </ol>
            </nav>
        </div>
    </div>


    <div class="container">
        <div class="row">

            <div class="col-lg-4 sidebar">

                <div class="widgets-container">

                    <div class="product-categories-widget widget-item">

                        <h3 class="widget-title">Kategori</h3>

                        <ul class="category-tree list-unstyled mb-0">
                            @foreach ($categories as $category)
                               <li class="category-item">
                                <div class="d-flex justify-content-between align-items-center category-header">
                                    <a href="{{ url('category/' . $category->slug) }}" class="category-link">{{ $category->name }}</a>
                                </div>
                            </li>
                            @endforeach
                        </ul>

                    </div>

                </div>

            </div>

            <div class="col-lg-8">


                <!-- Category Product List Section -->
                <section id="category-product-list" class="category-product-list section">

                    <div class="container mt-5 " data-aos="fade-up" data-aos-delay="100">

                        <div class="row gy-4">

                            @foreach ($products as $product)
                                <div class="col-lg-6">
                                    <div class="product-box">
                                        <div class="product-thumb">
                                            <span class="product-label">{{ $product->category->name }}</span>
                                            <img src="{{ asset('asset/produk/' . $product->image) }}" alt="Product Image"
                                                class="main-img" loading="lazy">

                                        </div>
                                        <div class="product-content">
                                            <div class="product-details">
                                                <h3 class="product-title"><a
                                                        href="{{ url('produk/' . $product->slug) }}">{{ $product->name }}</a>
                                                </h3>
                                                <div class="product-price">
                                                    <span>Rp{{ number_format($product->price) }}</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                    </div>

                </section>
            </div>
        </div>
    </div>


@endsection
