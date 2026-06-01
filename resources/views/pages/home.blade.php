@extends('layouts.app')
@section('title','home')

@section('styles')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection

@section('content')




{{-----------------------------     hero banner      -----------------------}}
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



{{-----------------------------     New Arricals      -----------------------}}
<section class="new-arrivals">
    <div class="container">
        
        {{--title--}}
        <div class="section-header">
            <h2 class="section-title">New Arrivals</h2>
        </div>

        {{--card wrapper--}}
        <div class="arrivals-wrapper">
            <div class="arrivals-track" id="arrivalsTrack">
                
                {{--card 1--}}
                <div class="product-card">
                    <div class="card-image-wrap">
                        <img src="{{asset('images/products/product-1.jpg')}}" alt="product" class="card-img">
                    </div>

                    {{--label--}}
                    <div class="label">
                        <span class="label-new">NEW</span>
                        <span class="label-sale">20% OFF</span>
                    </div>

                    <div class="card-body">
                        
                        {{--price--}}
                        <div class="price-wrap">
                            <span class="price-discount">Rs.1490</span>    
                            <span class="price-actual">Rs.1990</span>  
                        </div>

                        {{-- produc name --}}
                        <h6 class="card-product-name">ProBook Laptop 15 inch Intel i7 16GB RAM 512GB SSD</h6>

                        {{-- rating and cart btn --}}
                        <div class="card-footer-row">
                            <div class="star-rating">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                            </div>

                            <button class="add-to-cart-btn">
                                <img src="{{ asset('images/icons/cart-btn.svg') }}" alt="cart" class="cart-btn-icon">
                                <span>Add to Cart</span>
                            </button>
                        </div>
                    </div>
                </div>


                {{--card 2 --}}
                <div class="product-card">
                    <div class="card-image-wrap">
                        <img src="{{asset('images/products/product-1.jpg')}}" alt="product" class="card-img">
                    </div>

                    {{--label--}}
                    <div class="label">
                        <span class="label-new">NEW</span>
                        <span class="label-sale">20% OFF</span>
                    </div>

                    <div class="card-body">
                        
                        {{--price--}}
                        <div class="price-wrap">
                            <span class="price-discount">Rs.1490</span>    
                            <span class="price-actual">Rs.1990</span>
                        </div>

                        {{-- produc name --}}
                        <h6 class="card-product-name">ProBook Laptop 15 inch Intel i7 16GB RAM 512GB SSD</h6>

                        {{-- rating and cart btn --}}
                        <div class="card-footer-row">
                            <div class="star-rating">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                            </div>

                            <button class="add-to-cart-btn">
                                <img src="{{ asset('images/icons/cart-btn.svg') }}" alt="cart" class="cart-btn-icon">
                                <span>Add to Cart</span>
                            </button>
                        </div>
                    </div>
                </div>


                {{--card 3--}}
                <div class="product-card">
                    <div class="card-image-wrap">
                        <img src="{{asset('images/products/product-1.jpg')}}" alt="product" class="card-img">
                    </div>

                    {{--label--}}
                    <div class="label">
                        <span class="label-new">NEW</span>
                        <span class="label-sale">20% OFF</span>
                    </div>

                    <div class="card-body">
                        
                        {{--price--}}
                        <div class="price-wrap">
                            <span class="price-discount">Rs.1490</span>    
                            <span class="price-actual">Rs.1990</span>
                        </div>

                        {{-- produc name --}}
                        <h6 class="card-product-name">ProBook Laptop 15 inch Intel i7 16GB RAM 512GB SSD</h6>

                        {{-- rating and cart btn --}}
                        <div class="card-footer-row">
                            <div class="star-rating">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                            </div>

                            <button class="add-to-cart-btn">
                                <img src="{{ asset('images/icons/cart-btn.svg') }}" alt="cart" class="cart-btn-icon">
                                <span>Add to Cart</span>
                            </button>
                        </div>
                    </div>
                </div>


                {{--card 4--}}
                <div class="product-card">
                    <div class="card-image-wrap">
                        <img src="{{asset('images/products/product-1.jpg')}}" alt="product" class="card-img">
                    </div>

                    {{--label--}}
                    <div class="label">
                        <span class="label-new">NEW</span>
                        <span class="label-sale">20% OFF</span>
                    </div>

                    <div class="card-body">
                        
                        {{--price--}}
                        <div class="price-wrap">
                            <span class="price-discount">Rs.1490</span>    
                            <span class="price-actual">Rs.1990</span>
                        </div>

                        {{-- produc name --}}
                        <h6 class="card-product-name">ProBook Laptop 15 inch Intel i7 16GB RAM 512GB SSD</h6>

                        {{-- rating and cart btn --}}
                        <div class="card-footer-row">
                            <div class="star-rating">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                            </div>

                            <button class="add-to-cart-btn">
                                <img src="{{ asset('images/icons/cart-btn.svg') }}" alt="cart" class="cart-btn-icon">
                                <span>Add to Cart</span>
                            </button>
                        </div>
                    </div>
                </div>


                {{--card 5--}}
                <div class="product-card">
                    <div class="card-image-wrap">
                        <img src="{{asset('images/products/product-1.jpg')}}" alt="product" class="card-img">
                    </div>

                    {{--label--}}
                    <div class="label">
                        <span class="label-new">NEW</span>
                        <span class="label-sale">20% OFF</span>
                    </div>

                    <div class="card-body">
                        
                        {{--price--}}
                        <div class="price-wrap">
                            <span class="price-discount">Rs.1490</span>    
                            <span class="price-actual">Rs.1990</span>
                        </div>

                        {{-- produc name --}}
                        <h6 class="card-product-name">ProBook Laptop 15 inch Intel i7 16GB RAM 512GB SSD</h6>

                        {{-- rating and cart btn --}}
                        <div class="card-footer-row">
                            <div class="star-rating">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                            </div>

                            <button class="add-to-cart-btn">
                                <img src="{{ asset('images/icons/cart-btn.svg') }}" alt="cart" class="cart-btn-icon">
                                <span>Add to Cart</span>
                            </button>
                        </div>
                    </div>
                </div>


                {{--card 6--}}
                <div class="product-card">
                    <div class="card-image-wrap">
                        <img src="{{asset('images/products/product-1.jpg')}}" alt="product" class="card-img">
                    </div>

                    {{--label--}}
                    <div class="label">
                        <span class="label-new">NEW</span>
                        <span class="label-sale">20% OFF</span>
                    </div>

                    <div class="card-body">
                        
                        {{--price--}}
                        <div class="price-wrap">
                            <span class="price-discount">Rs.1490</span>    
                            <span class="price-actual">Rs.1990</span>
                        </div>

                        {{-- produc name --}}
                        <h6 class="card-product-name">ProBook Laptop 15 inch Intel i7 16GB RAM 512GB SSD</h6>

                        {{-- rating and cart btn --}}
                        <div class="card-footer-row">
                            <div class="star-rating">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                            </div>

                            <button class="add-to-cart-btn">
                                <img src="{{ asset('images/icons/cart-btn.svg') }}" alt="cart" class="cart-btn-icon">
                                <span>Add to Cart</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>



@endsection
