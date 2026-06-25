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
                <button type="button" data-bs-target="#heroBanner" data-bs-slide-to="2"></button>
                <button type="button" data-bs-target="#heroBanner" data-bs-slide-to="3"></button>
            </div>

            {{-- Slides --}}
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('images/banners/hero1.svg') }}" class="hero-img" alt="Banner 1">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/banners/hero1.svg') }}" class="hero-img" alt="Banner 2">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/banners/hero1.svg') }}" class="hero-img" alt="Banner 3">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/banners/hero1.svg') }}" class="hero-img" alt="Banner 4">
                </div>
            </div>

        </div>
    </section>



    {{-- ---------------------------     New Arrivals      --------------------- --}}
    <section class="new-arrivals">
        <div class="container">

            {{-- title --}}
            <div class="section-header">
                <h2 class="section-title">New Arrivals</h2>
                <a href="/products" class="section-view-all">View All</a>
            </div>

            {{-- card wrapper --}}
            <div class="arrivals-wrapper">
                <div class="arrivals-track" id="arrivalsTrack">

                    {{-- card 1 --}}
                    @foreach ($products as $product)
                        <div class="product-card">
                            <div class="card-image-wrap">
                                <img src="{{ asset('images/products/product-1.jpg') }}" alt="product" class="card-img">
                            </div>

                            <div class="card-body">

                                {{-- price --}}
                                <div class="price-wrap">
                                    <span class="product-price">Rs.1490</span>
                                </div>

                                {{-- produc name --}}
                                <a href="#" class="card-product-name">ProBook Laptop 15 inch Intel i7 16GB RAM 512GB
                                    SSD</a>

                                {{-- rating and cart btn --}}
                                <div class="card-footer-row">
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="add-to-cart-btn">
                                            <img src="{{ asset('images/icons/cart-btn.svg') }}" alt="cart"
                                                class="cart-btn-icon">
                                            <span>Add to Cart</span>
                                        </button>

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


                    {{-- card 2 --}}
                    <div class="product-card">
                        <div class="card-image-wrap">
                            <img src="{{ asset('images/products/product-1.jpg') }}" alt="product" class="card-img">
                        </div>

                        {{-- label --}}
                        <div class="label">

                        </div>

                        <div class="card-body">
                            {{-- price --}}
                            <div class="price-wrap">
                                <span class="label-new">NEW</span>
                                <span class="product-price">Rs.1490</span>
                            </div>

                            {{-- produc name --}}
                            <a href="#" class="card-product-name">ProBook Laptop 15 inch Intel i7 16GB RAM 512GB
                                SSD</a>

                            {{-- cart btn --}}
                            <div class="card-footer-row">
                                <button class="add-to-cart-btn">
                                    <img src="{{ asset('images/icons/cart-btn.svg') }}" alt="cart"
                                        class="cart-btn-icon">
                                    <span>Add to Cart</span>
                                </button>
                            </div>
                        </div>
                    </div>


                    {{-- card 3 --}}
                    <div class="product-card">
                        <div class="card-image-wrap">
                            <img src="{{ asset('images/products/product-1.jpg') }}" alt="product" class="card-img">
                        </div>

                        {{-- label --}}
                        <div class="label">

                        </div>

                        <div class="card-body">
                            {{-- price --}}
                            <div class="price-wrap">
                                <span class="label-new">NEW</span>
                                <span class="product-price">Rs.1490</span>
                            </div>

                            {{-- produc name --}}
                            <a href="#" class="card-product-name">ProBook Laptop 15 inch Intel i7 16GB RAM 512GB
                                SSD</a>

                            {{-- cart btn --}}
                            <div class="card-footer-row">
                                <button class="add-to-cart-btn">
                                    <img src="{{ asset('images/icons/cart-btn.svg') }}" alt="cart"
                                        class="cart-btn-icon">
                                    <span>Add to Cart</span>
                                </button>
                            </div>
                        </div>
                    </div>


                    {{-- card 4 --}}
                    <div class="product-card">
                        <div class="card-image-wrap">
                            <img src="{{ asset('images/products/product-1.jpg') }}" alt="product" class="card-img">
                        </div>

                        {{-- label --}}
                        <div class="label">

                        </div>

                        <div class="card-body">
                            {{-- price --}}
                            <div class="price-wrap">
                                <span class="label-new">NEW</span>
                                <span class="product-price">Rs.1490</span>
                            </div>

                            {{-- produc name --}}
                            <a href="#" class="card-product-name">ProBook Laptop 15 inch Intel i7 16GB RAM 512GB
                                SSD</a>

                            {{-- cart btn --}}
                            <div class="card-footer-row">
                                <button class="add-to-cart-btn">
                                    <img src="{{ asset('images/icons/cart-btn.svg') }}" alt="cart"
                                        class="cart-btn-icon">
                                    <span>Add to Cart</span>
                                </button>
                            </div>
                        </div>
                    </div>



                    {{-- card 5 --}}
                    <div class="product-card">
                        <div class="card-image-wrap">
                            <img src="{{ asset('images/products/product-1.jpg') }}" alt="product" class="card-img">
                        </div>

                        {{-- label --}}
                        <div class="label">

                        </div>

                        <div class="card-body">
                            {{-- price --}}
                            <div class="price-wrap">
                                <span class="label-new">NEW</span>
                                <span class="product-price">Rs.1490</span>
                            </div>

                            {{-- produc name --}}
                            <a href="#" class="card-product-name">ProBook Laptop 15 inch Intel i7 16GB RAM 512GB
                                SSD</a>

                            {{-- cart btn --}}
                            <div class="card-footer-row">
                                <button class="add-to-cart-btn">
                                    <img src="{{ asset('images/icons/cart-btn.svg') }}" alt="cart"
                                        class="cart-btn-icon">
                                    <span>Add to Cart</span>
                                </button>
                            </div>
                        </div>
                    </div>



                    {{-- card 6 --}}
                    <div class="product-card">
                        <div class="card-image-wrap">
                            <img src="{{ asset('images/products/product-1.jpg') }}" alt="product" class="card-img">
                        </div>

                        {{-- label --}}
                        <div class="label">

                        </div>

                        <div class="card-body">
                            {{-- price --}}
                            <div class="price-wrap">
                                <span class="label-new">NEW</span>
                                <span class="product-price">Rs.1490</span>
                            </div>

                            {{-- produc name --}}
                            <a href="#" class="card-product-name">ProBook Laptop 15 inch Intel i7 16GB RAM 512GB
                                SSD</a>

                            {{-- cart btn --}}
                            <div class="card-footer-row">
                                <button class="add-to-cart-btn">
                                    <img src="{{ asset('images/icons/cart-btn.svg') }}" alt="cart"
                                        class="cart-btn-icon">
                                    <span>Add to Cart</span>
                                </button>
                            </div>
                        </div>
                    </div>


                    {{-- card 7 --}}
                    <div class="product-card">
                        <div class="card-image-wrap">
                            <img src="{{ asset('images/products/product-1.jpg') }}" alt="product" class="card-img">
                        </div>

                        {{-- label --}}
                        <div class="label">

                        </div>

                        <div class="card-body">
                            {{-- price --}}
                            <div class="price-wrap">
                                <span class="label-new">NEW</span>
                                <span class="product-price">Rs.1490</span>
                            </div>

                            {{-- produc name --}}
                            <a href="#" class="card-product-name">ProBook Laptop 15 inch Intel i7 16GB RAM 512GB
                                SSD</a>

                            {{-- cart btn --}}
                            <div class="card-footer-row">
                                <button class="add-to-cart-btn">
                                    <img src="{{ asset('images/icons/cart-btn.svg') }}" alt="cart"
                                        class="cart-btn-icon">
                                    <span>Add to Cart</span>
                                </button>
                            </div>
                        </div>
                    </div>


                </div>

                {{-- left arrow --}}
                <button class="arrivals-arrow arrivals-arrow-left" id="arrivalsArrowLeft">
                    <img src="{{ asset('images/icons/arrow-right.svg') }}" alt="prev" class="arrivals-arrow-icon">
                </button>

                {{-- right arrow --}}
                <button class="arrivals-arrow arrivals-arrow-right" id="arrivalsArrowRight">
                    <img src="{{ asset('images/icons/arrow-right.svg') }}" alt="next" class="arrivals-arrow-icon">
                </button>
            </div>
        </div>
    </section>

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



@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const track = document.getElementById('arrivalsTrack');
            const arrowRight = document.getElementById('arrivalsArrowRight');
            const arrowLeft = document.getElementById('arrivalsArrowLeft');

            // ── Arrow click scroll ──
            const card = track.querySelector('.product-card');
            const cardWidth = card.offsetWidth + 16;

            arrowRight.addEventListener('click', function() {
                track.scrollBy({
                    left: cardWidth,
                    behavior: 'smooth'
                });
            });

            arrowLeft.addEventListener('click', function() {
                track.scrollBy({
                    left: -cardWidth,
                    behavior: 'smooth'
                });
            });

            // ── Show / hide arrows on scroll ──
            function updateArrows() {
                const atStart = track.scrollLeft <= 10;
                const atEnd = track.scrollLeft + track.clientWidth >= track.scrollWidth - 10;

                arrowLeft.style.opacity = atStart ? '0' : '1';
                arrowLeft.style.pointerEvents = atStart ? 'none' : 'auto';

                arrowRight.style.opacity = atEnd ? '0' : '1';
                arrowRight.style.pointerEvents = atEnd ? 'none' : 'auto';
            }

            track.addEventListener('scroll', updateArrows);
            updateArrows();

            // ── Mouse drag to scroll ──
            let isDown = false;
            let startX = 0;
            let scrollStart = 0;

            track.addEventListener('mousedown', function(e) {
                isDown = true;
                startX = e.pageX - track.offsetLeft;
                scrollStart = track.scrollLeft;
                track.classList.add('dragging');
            });

            document.addEventListener('mouseup', function() {
                isDown = false;
                track.classList.remove('dragging');
                track.style.scrollSnapType = 'x mandatory';
                /* Re-enable snap after drag ends
                   so card snaps into place */
            });

            document.addEventListener('mousemove', function(e) {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - track.offsetLeft;
                const walk = (x - startX) * 1.5;
                /* Multiply by 1.5 makes drag feel
                   faster and more natural */
                track.scrollLeft = scrollStart - walk;
            });

            // ── Touch swipe (mobile) ──
            let touchStartX = 0;
            let touchScrollStart = 0;

            track.addEventListener('touchstart', function(e) {
                touchStartX = e.touches[0].pageX;
                touchScrollStart = track.scrollLeft;
            }, {
                passive: true
            });

            track.addEventListener('touchmove', function(e) {
                const x = e.touches[0].pageX;
                const walk = touchStartX - x;
                track.scrollLeft = touchScrollStart + walk;
            }, {
                passive: true
            });

        });
    </script>
@endsection
