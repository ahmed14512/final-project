@extends('layouts.app')

@section('title', 'Product - SmartPickz')

@section('styles')
    <link href="{{ asset('css/product.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection


@section('content')

    <section class="product-detial-section">
        <div class="container">
            <div class="product-detail-layout">

                {{-- ------------product image------------ --}}
                <div class="product-images">
                    <div class="product-main-img-wrap">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="product-main-img" id="mainImage">
                    </div>

                    {{-- ------------thumb------------ --}}
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

                    {{-- ------------brand------------ --}}

                    <div class="product-brand-row">
                        <img src="{{ asset('storage/' . $product->brand->logo) }}" alt="{{ $product->brand->name }}"
                            class="product-brand-logo">
                        <a href="/products?brand={{ $product->brand->id }}" class="product-brand-link">
                            Show all {{ $product->brand->name }} products
                        </a>
                    </div>

                    {{-- ------------name------------ --}}
                    <h2 class="product-name">
                        {{ $product->name }}
                    </h2>

                    {{-- ------------sku and rating------------ --}}
                    <div class="product-meta-row">
                        <span class="product-sku"> SKU: {{ $product->sku }}</span>

                        {{-- Availability --}}
                        <div class="product-availability">
                            <span class="availability-dot"></span>
                            <span class="availability-text">{{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}</span>
                        </div>
                    </div>



                    {{-- Price --}}
                    <div class="product-price-row">
                        <span class="product-price">Rs. {{ $product->price }}</span>
                    </div>

                    {{-- Divider --}}
                    <hr class="product-divider">

                    {{-- Short description --}}
                    <div>
                        <h3 class="short-des-title">About this Item</h3>

                        <ul class="product-short-desc">
                            {{ $product->description }}
                        </ul>
                    </div>



                    {{-- action btn --}}
                    <div class="product-actions">

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

                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- -----------specification------------- --}}
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


        // ── Quantity change 
        function changeQty(amount) {
            const input = document.getElementById('qtyInput');
            let val = parseInt(input.value) + amount;
            if (val < 1) val = 1;
            if (val > 99) val = 99;
            input.value = val;
        }
    </script>
@endsection
