@extends('layouts.app')

@section('title', 'Product - SmartPickz')

@section('styles')
    <link href="{{ asset('css/product.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a class="text-decoration-none" href="{{ route('home') }}">Home</a>
    </li>
    <li class="breadcrumb-item">
        <a class="text-decoration-none" href="{{ route('products.index') }}">Products</a>
    </li>
    <li class="breadcrumb-item active">{{ $product->name }}</li>
@endsection


@section('content')

    <section class="product-detial-section">
        <div class="container">
            <div class="product-detail-layout">

                {{-- product images --}}
                <div class="product-images">
                    <div class="product-main-img-wrap">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="product-main-img" id="mainImage">
                    </div>

                    {{-- thumb --}}
                    <div class="product-thumbs">
                        @foreach ($product->images as $thumb)
                            <div class="thumb" onclick="changeImage(this, '{{ asset('storage/' . $thumb->image) }}')">
                                <img src="{{ asset('storage/' . $thumb->image) }}" alt="{{ $thumb->image }}">
                            </div>
                        @endforeach
                    </div>
                </div>


                {{-- ------------product details------------ --}}
                <div class="product-details">

                    {{-- brnad --}}

                    <div class="product-brand-row">
                        <img src="{{ asset('storage/' . $product->brand->logo) }}" alt="{{ $product->brand->name }}"
                            class="product-brand-logo">
                        <a href="/products?brand[]={{ $product->brand->id }}" class="product-brand-link">
                            Show all {{ $product->brand->name }} products
                        </a>
                    </div>

                    {{-- product name --}}
                    <h2 class="product-name">
                        {{ $product->name }}
                    </h2>

                    {{-- ------------sku and rating------------ --}}
                    <div class="product-meta-row">
                        <span class="product-sku"> SKU: {{ $product->sku }}</span>

                        {{-- Availability --}}
                        <div class="product-availability">
                            <span class="availability-dot {{ $product->stock > 0 ? 'in-stock' : 'out-stock' }}"></span>
                            <span class="availability-text {{ $product->stock > 0 ? 'in-stock' : 'out-stock' }}">
                                {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}</span>
                        </div>
                    </div>



                    {{-- price --}}
                    <div class="product-price-row">
                        <span class="product-price">Rs. {{ $product->price }}</span>
                    </div>

                    <hr class="product-divider">

                    {{-- description --}}
                    <div>
                        <h3 class="short-des-title">About this Item</h3>

                        <ul class="product-short-desc">
                            {!! $product->description !!}
                        </ul>
                    </div>



                    {{-- add to cart btn --}}
                    <div class="product-actions">

                        @if ($product->stock > 0)
                            <form action="{{ route('cart.buyNow') }}" method="POST" style="display:inline">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn-buy-now">
                                    Buy Now
                                </button>
                            </form>

                            <form action="{{ route('cart.add') }}" method="POST" style="display:inline">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn-add-to-cart">
                                    Add to Cart
                                </button>
                            </form>
                        @else
                            <button class="out-of-stock-btn" disabled style="cursor:not-allowed;">
                                <span>Out of Stock</span>
                            </button>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- spec imafe --}}
    <section>
        @if ($product->spec_image)
            <div class="container">
                <img src="{{ asset('storage/' . $product->spec_image) }}" alt="specifications" class="spec-img">
            </div>
        @endif

    </section>


@endsection


@section('scripts')

    <script>
        // thumbnail click 
        function changeImage(thumb, src) {
            document.getElementById('mainImage').src = src;
            document.querySelectorAll('.thumb').forEach(function(t) {
                t.classList.remove('active');
            });
            thumb.classList.add('active');
        }
    </script>
@endsection
