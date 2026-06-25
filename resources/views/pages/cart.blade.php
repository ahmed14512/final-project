@extends('layouts.app')

@section('title', 'Cart - SmartPickz')

@section('styles')
    <link href="{{ asset('css/cart.css') }}" rel="stylesheet">
    <link href="{{ asset('css/order-summary.css') }}" rel="stylesheet">
@endsection


@section('content')

    <section class="cart-section">
        <div class="container">

            <h1 class="cart-page-title"> My Cart ( {{ $cartItems->count() }}) </h1>


            @if ($cartItems->count() > 0)
                <div class="cart-layout">
                    {{-- -------------- left cart items ------------- --}}
                    <div class="cart-item-wrap">

                        {{-- -------------- cart product 1 ------------- --}}
                        @foreach ($cartItems as $item)
                            <div class="cart-item">

                                {{-- ----- thumb images ---- --}}
                                <div class="cart-item-img-wrap">
                                    <img src="{{ asset('storage/' . $item->product->image) }}"
                                        alt={{ $item->product->name }} class="cart-item-img">
                                </div>


                                {{-- ----- item info ---- --}}
                                <div class="cart-item-info">
                                    <a href="/products/{{ $item->product->id }}" class="cart-item-name">
                                        {{ $item->product->name }}
                                    </a>
                                    <span class="cart-item-sku"> SKU:{{ $item->product->sku }}</span>

                                    <div class="cart-item-actions">
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST"
                                            style="display:inline">

                                            @csrf
                                            @method('DELETE')

                                            <button class="cart-action-btn cart-remove-btn">
                                                <img src="{{ asset('images/icons/trash.svg') }}" alt="remove"
                                                    class="cart-action-icon">
                                                <span>Remove</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <div class="cart-item-price-wrap">
                                    <div class="cart-item-price">Rs. {{ $item->product->price }}</div>

                                    <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <div class="qty-wrap">
                                            <button type="submit" class="qty-btn" name="quantity"
                                                value={{ $item->quantity - 1 }}
                                                {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                                − </button>

                                            <input type="number" class="qty-input" value={{ $item->quantity }}
                                                min="1" max="99" readonly>
                                            <button type="submit" name="quantity" class="qty-btn"
                                                value="{{ $item->quantity + 1 }}">+</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>


                    {{-- Order Summary --}}
                    @include('partials.order-summary')
                    <div>
                        <a href="/checkout" class="checkout-btn">
                            Continue to Checkout
                            <img src="{{ asset('images/icons/arrow-right.svg') }}" alt="next"
                                class="checkout-next-icon">
                        </a>
                    </div>
                </div>
            @else
                {{-- Empty cart state --}}
                <div class="text-center py-5">
                    <h3 class="mt-3 text-muted">Your cart is empty</h3>
                    <p class="text-muted">Add some products to get started!</p>
                    <a href="/products" class="btn btn-primary mt-2">
                        Shop Now
                    </a>
                </div>
            @endif

        </div>
    </section>

@endsection
