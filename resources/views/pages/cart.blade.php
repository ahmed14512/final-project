@extends('layouts.app')

@section('title', 'Cart - SmartPickz')

@section('styles')
    <link href="{{ asset('css/cart.css') }}" rel="stylesheet">
    <link href="{{ asset('css/order-summary.css') }}" rel="stylesheet">
@endsection


@section('content')

<section class="cart-section">
    <div class="container">
        <h1 class="cart-page-title"> My Cart </h1>

        <div class="cart-layout">            
            {{---------------- left cart items ---------------}}
            <div class="cart-item-wrap">
                
                {{---------------- cart product 1 ---------------}}
                <div class="cart-item">
                    
                    {{------- thumb images ------}}
                    <div class="cart-item-img-wrap">
                        <img src="{{ asset('images/products/product-1.jpg') }}" alt="product" class="cart-item-img">
                    </div>
                    

                    {{------- item info ------}}
                    <div class="cart-item-info">
                        <a href="/products/1" class="cart-item-name">
                                ProBook Laptop 15 inch Intel i7 16GB RAM 512GB SSD
                        </a>
                        <span class="cart-item-sku">SKU: SP-001234</span>
                            
                        <div class="cart-item-actions">
                            <button class="cart-action-btn cart-remove-btn">
                                <img src="{{ asset('images/icons/trash.svg') }}" alt="remove" class="cart-action-icon">
                                    <span>Remove</span>
                            </button>
                                    
                            <button class="cart-action-btn cart-wishlist-btn">
                                <img src="{{ asset('images/icons/wishlist.svg') }}" alt="wishlist" class="cart-action-icon">
                                    <span>Move to Wishlist</span>
                            </button>
                        </div>            
                    </div>

                    <div class="cart-item-price-wrap">
                        <div class="cart-item-price">Rs. 89,900</div>
                            <div class="qty-wrap">
                                <button class="qty-btn" onclick="changeQty(this, -1)">−</button>
                                <input type="number" class="qty-input" value="1" min="1" max="99" readonly>
                                <button class="qty-btn" onclick="changeQty(this, 1)">+</button>
                            </div>
                    </div>
                </div>

                {{---------------- cart product 2 ---------------}}
                <div class="cart-item">
                    
                    {{------- thumb images ------}}
                    <div class="cart-item-img-wrap">
                        <img src="{{ asset('images/products/product-1.jpg') }}" alt="product" class="cart-item-img">
                    </div>
                    

                    {{------- item info ------}}
                    <div class="cart-item-info">
                        <a href="/products/1" class="cart-item-name">
                                ProBook Laptop 15 inch Intel i7 16GB RAM 512GB SSD
                        </a>
                        <span class="cart-item-sku">SKU: SP-001234</span>
                            
                        <div class="cart-item-actions">
                            <button class="cart-action-btn cart-remove-btn">
                                <img src="{{ asset('images/icons/trash.svg') }}" alt="remove" class="cart-action-icon">
                                    <span>Remove</span>
                            </button>
                                    
                            <button class="cart-action-btn cart-wishlist-btn">
                                <img src="{{ asset('images/icons/wishlist.svg') }}" alt="wishlist" class="cart-action-icon">
                                    <span>Move to Wishlist</span>
                            </button>
                        </div>            
                    </div>

                    <div class="cart-item-price-wrap">
                        <div class="cart-item-price">Rs. 89,900</div>
                            <div class="qty-wrap">
                                <button class="qty-btn" onclick="changeQty(this, -1)">−</button>
                                <input type="number" class="qty-input" value="1" min="1" max="99" readonly>
                                <button class="qty-btn" onclick="changeQty(this, 1)">+</button>
                            </div>
                    </div>
                </div>    
            </div>
            
            
            {{-- Order Summary --}}
            @include('partials.order-summary')
            <div>
                <a href="/checkout" class="checkout-btn">
                    Continue to Checkout
                <img src="{{ asset('images/icons/arrow-right.svg') }}"  alt="next" class="checkout-next-icon">
                </a>
            </div>

            
        </div>
        
    </div>
</section>

@endsection

@section('scripts')
<script>
    function changeQty(btn, amount) {
        const input = btn.parentElement.querySelector('.qty-input');
        let val = parseInt(input.value) + amount;
        if (val < 1) val = 1;
        if (val > 99) val = 99;
        input.value = val;
    }
</script>
@endsection
