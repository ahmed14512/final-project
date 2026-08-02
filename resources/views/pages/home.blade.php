@extends('layouts.app')
@section('title', 'home')

@section('styles')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection

@section('content')




    {{-- ---------------------------     hero banner      --------------------- --}}
    <section class="hero-section">
        <div id="heroBanner" class="carousel slide container" data-bs-ride="carousel" data-bs-interval="4000">

            {{-- Dots --}}
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroBanner" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#heroBanner" data-bs-slide-to="1"></button>
            </div>

            {{-- Slides --}}
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <a href="/products?category[]=1">
                        <img src="{{ asset('images/banners/hero1.jpg') }}" class="hero-img" alt="Banner 1">
                    </a>
                </div>

                <div class="carousel-item">
                    <a href="/products?category[]=2">
                        <img src="{{ asset('images/banners/hero2.jpg') }}" class="hero-img" alt="Banner 2">
                    </a>
                </div>
            </div>

        </div>
    </section>



    {{-- ---------------------------    new arricval      --------------------- --}}
    <section class="new-arrivals">
        <div class="container">

            {{-- title --}}
            <div class="section-header">
                <h2 class="section-title">New Arrivals</h2>
                <a href="/products" class="section-view-all">View All</a>
            </div>

            <div class="arrivals-grid">

                {{-- card 1 --}}
                @foreach ($products as $product)
                    <div class="product-card">
                        <div class="card-image-wrap">
                            <a href="{{ route('products.show', $product->id) }}"></a>
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/no-img.jpg') }}"
                                alt="{{ $product->name }}" class="card-img">
                        </div>

                        <div class="card-body">

                            {{-- price --}}
                            <div class="price-wrap">
                                <span class="product-price">Rs.{{ number_format($product->price) }}</span>
                            </div>

                            {{-- produc name --}}
                            <a href="{{ route('products.show', $product->id) }}"
                                class="card-product-name">{{ $product->name }}
                            </a>

                            {{-- cart btn --}}
                            <div class="card-footer-row">
                                @if ($product->stock > 0)
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="add-to-cart-btn">
                                            <img src="{{ asset('images/icons/cart-btn.svg') }}" alt="cart"
                                                class="cart-btn-icon">
                                            <span>Add to Cart</span>
                                        </button>
                                    </form>
                                @else
                                    <button class="out-of-stock-btn" disabled style="cursor:not-allowed;">
                                        <span>Out of Stock</span>
                                    </button>
                                @endif

                                @if (session('success'))
                                    <div class="alert alert-success text-center m-1 rounded-0 p-1">
                                        {{ session('success') }}
                                    </div>
                                @endif


                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

    </section>

    {{-- ---------------------------    50 banner     --------------------- --}}

    <section class="promo-section">
        <div class="container">
            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <a href="#" class="promo-banner">
                        <img src="{{ asset('images/banners/promo1.jpg') }}" alt="promo-1" class="promo-img">
                    </a>
                </div>

                <div class="col-12 col-md-6">
                    <a href="#" class="promo-banner">
                        <img src="{{ asset('images/banners/promo2.jpg') }}" alt="promo-2" class="promo-img">
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ---------------------------     mobile phones      --------------------- --}}
    <section class="new-arrivals">
        <div class="container">

            {{-- title --}}
            <div class="section-header">
                <h2 class="section-title">Moible Phones</h2>
                <a href="/products?category[]=3" class="section-view-all">View All</a>
            </div>

            <div class="arrivals-grid">

                {{-- card 1 --}}
                @foreach ($mobilePhones as $product)
                    <div class="product-card">
                        <div class="card-image-wrap">
                            <a href="{{ route('products.show', $product->id) }}"></a>
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/no-img.jpg') }}"
                                alt="{{ $product->name }}" class="card-img">
                        </div>

                        <div class="card-body">

                            {{-- price --}}
                            <div class="price-wrap">
                                <span class="product-price">Rs.{{ number_format($product->price) }}</span>
                            </div>

                            {{-- produc name --}}
                            <a href="{{ route('products.show', $product->id) }}"
                                class="card-product-name">{{ $product->name }}
                            </a>

                            {{-- cart btn --}}
                            <div class="card-footer-row">
                                @if ($product->stock > 0)
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="add-to-cart-btn">
                                            <img src="{{ asset('images/icons/cart-btn.svg') }}" alt="cart"
                                                class="cart-btn-icon">
                                            <span>Add to Cart</span>
                                        </button>
                                    @else
                                        <button class="out-of-stock-btn" disabled style="cursor:not-allowed;">
                                            <span>Out of Stock</span>
                                        </button>
                                @endif

                                @if (session('success'))
                                    <div class="alert alert-success text-center m-1 rounded-0 p-1">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    {{-- ---------------------------     laptop anc computersa      --------------------- --}}
    <section class="new-arrivals">
        <div class="container">

            {{-- title --}}
            <div class="section-header">
                <h2 class="section-title">Computers &amp; Laptop</h2>
                <a href="/products?category[]=2" class="section-view-all">View All</a>
            </div>

            <div class="arrivals-grid">

                {{-- card 1 --}}
                @foreach ($laptops as $product)
                    <div class="product-card">
                        <div class="card-image-wrap">
                            <a href="{{ route('products.show', $product->id) }}"></a>
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/no-img.jpg') }}"
                                alt="{{ $product->name }}" class="card-img">
                        </div>

                        <div class="card-body">

                            {{-- price --}}
                            <div class="price-wrap">
                                <span class="product-price">Rs.{{ number_format($product->price) }}</span>
                            </div>

                            {{-- produc name --}}
                            <a href="{{ route('products.show', $product->id) }}"
                                class="card-product-name">{{ $product->name }}
                            </a>

                            {{-- cart btn --}}
                            <div class="card-footer-row">
                                @if ($product->stock > 0)
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="add-to-cart-btn">
                                            <img src="{{ asset('images/icons/cart-btn.svg') }}" alt="cart"
                                                class="cart-btn-icon">
                                            <span>Add to Cart</span>
                                        </button>
                                    @else
                                        <button class="out-of-stock-btn" disabled style="cursor:not-allowed;">
                                            <span>Out of Stock</span>
                                        </button>
                                @endif

                                @if (session('success'))
                                    <div class="alert alert-success text-center m-1 rounded-0 p-1">
                                        {{ session('success') }}
                                    </div>
                                    </form>
                                @endif


                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

@endsection
