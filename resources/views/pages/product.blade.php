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
            
            {{--------------product image--------------}}
            <div class="product-images">
                <div class="product-main-img-wrap">
                    <img src="{{asset ('images/products/product-1.jpg')}}" alt="product-1" class="product-main-img" id="mainImage">
                </div>

                {{--------------thumb--------------}}
                <div class="product-thumbs">
                    <div class="thumb active"
                         onclick="changeImage(this, '{{ asset('images/products/product-1.jpg') }}')">
                        <img src="{{ asset('images/products/product-1.jpg') }}" alt="thumb">
                    </div>
                    <div class="thumb"
                         onclick="changeImage(this, '{{ asset('images/products/product-1.jpg') }}')">
                        <img src="{{ asset('images/products/product-1.jpg') }}" alt="thumb">
                    </div>
                    <div class="thumb"
                         onclick="changeImage(this, '{{ asset('images/products/product-1.jpg') }}')">
                        <img src="{{ asset('images/products/product-1.jpg') }}" alt="thumb">
                    </div>
                    <div class="thumb"
                         onclick="changeImage(this, '{{ asset('images/products/product-1.jpg') }}')">
                        <img src="{{ asset('images/products/product-1.jpg') }}" alt="thumb">
                    </div>

                    
                </div>
            </div>


            {{--------------product details--------------}}
            <div class="product-details">

                {{--------------brand--------------}}
                <div class="product-brand-row">
                    <img src="{{ asset('images/brands/samsung.png') }}" alt="samsung" class="product-brand-logo">
                    <a href="/products?brand=samsung" class="product-brand-link">
                        Show all Samsung products
                    </a>
                </div>

                {{--------------name--------------}}
                <h2 class="product-name">
                     ProBook Laptop 15 inch Intel i7 16GB RAM 512GB SSD
                </h2>

                 {{--------------sku and rating--------------}}
                <div class="product-meta-row">
                        <span class="product-sku">SKU: SP-001234</span>

                        {{-- Availability --}}
                        <div class="product-availability">
                            <span class="availability-dot"></span>
                            <span class="availability-text">In Stock</span>
                        </div>
                </div>

                

                {{-- Price --}}
                <div class="product-price-row">
                    <span class="product-price">Rs. 109,900</span>
                         
                    <button class="btn-wishlist">
                        <img src="{{ asset('images/icons/heart-white.svg') }}"
                             alt="wishlist" class="action-btn-icon">
                        <span>Add to Wishlist</span>
                    </button>
                </div>

                {{-- Divider --}}
                <hr class="product-divider">

                {{-- Short description --}}
                <div >
                    <h3 class="short-des-title">About this Item</h3>
                    
                    <ul class="product-short-desc">
                        <li>Experience next-level performance with the ProBook Laptop 15.</li>
                        <li>Experience next-level performance with the ProBook Laptop 15.</li>
                        <li>Experience next-level performance with the ProBook Laptop 15.</li>
                        <li>Experience next-level performance with the ProBook Laptop 15.</li>
                        <li>Experience next-level performance with the ProBook Laptop 15.</li>
                        <li>Experience next-level performance with the ProBook Laptop 15.</li>
                        <li>Experience next-level performance with the ProBook Laptop 15.</li>
                    </ul>
                </div>


                {{-- quantity --}}
                <div class="prodyct-qty-row">
                    <p class="qty-label">
                        Quantity
                    </p>
                    <div class="qty-wrap">
                        <button class="qty-btn" onclick="changeQty(-1)">-</button>
                        <input type="number" class="qty-input" id="qtyInput" value="1" min="1" max="99" readonly>
                        <button class="qty-btn" onclick="changeQty(1)">+</button>
                    </div>
                </div>

                {{-- action btn --}}
                <div class="product-actions">

                    <button class="btn-buy-now">
                        Buy Now
                    </button>
                
                    <button class="btn-add-to-cart">
                       Add to Cart
                    </button>
                </div>           
            </div>
        </div>
    </div>
</section>


{{-------------specification---------------}}
<section class="product-tabs-section">
    <div class="container">
        <div class="product-tabs-layout">

            {{-- ───── LEFT — Specifications ───── --}}
            <div class="spec-box">
                <h2 class="spec-title">Specifications</h2>

                <div class="spec-table" id="specTable">
                    <div class="spec-row">
                        <span class="spec-key">Brand</span>
                        <span class="spec-val">Samsung</span>
                    </div>
                    <div class="spec-row">
                        <span class="spec-key">Model</span>
                        <span class="spec-val">ProBook 15 2025</span>
                    </div>
                    <div class="spec-row">
                        <span class="spec-key">Processor</span>
                        <span class="spec-val">Intel Core i7 13th Gen</span>
                    </div>
                    <div class="spec-row">
                        <span class="spec-key">RAM</span>
                        <span class="spec-val">16GB DDR5</span>
                    </div>
                    <div class="spec-row">
                        <span class="spec-key">Storage</span>
                        <span class="spec-val">512GB NVMe SSD</span>
                    </div>
                    <div class="spec-row">
                        <span class="spec-key">Display</span>
                        <span class="spec-val">15.6" Full HD IPS</span>
                    </div>
                    <div class="spec-row">
                        <span class="spec-key">Battery</span>
                        <span class="spec-val">72Wh, Up to 10hrs</span>
                    </div>
                    <div class="spec-row">
                        <span class="spec-key">OS</span>
                        <span class="spec-val">Windows 11 Home</span>
                    </div>
                    <div class="spec-row">
                        <span class="spec-key">Weight</span>
                        <span class="spec-val">1.8 kg</span>
                    </div>
                    <div class="spec-row">
                        <span class="spec-key">Warranty</span>
                        <span class="spec-val">1 Year Local Warranty</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection


@section('scripts')
<script>

    // thumbnail click 
    function changeImage(thumb, src) {
        document.getElementById('mainImage').src = src;
        document.querySelectorAll('.thumb').forEach(function (t) {
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