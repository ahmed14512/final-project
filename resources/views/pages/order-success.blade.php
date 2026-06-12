@extends('layouts.app')

@section('title', 'Order Placed - SmartPickz')

@section('styles')
    <link href="{{ asset('css/checkout.css') }}" rel="stylesheet">
@endsection

@section('content')

<section class="success-section">
    <div class="container">
        <div class="success-card">

            {{-- Success icon --}}
            <div class="success-icon-wrap">
                <img src="{{ asset('images/icons/success.svg') }}"
                     alt="success" class="success-icon">
            </div>

            <h1 class="success-title">Order Placed Successfully!</h1>
            <p class="success-subtitle">
                Thank you for shopping with SmartPickz.
            </p>

            {{-- Order number --}}
            <div class="success-order-num">
                <span class="success-order-label">Order Number</span>
                <span class="success-order-val">#SP-2025-00123</span>
            </div>

            <p class="success-note">
                A confirmation email has been sent to your email address.
                You can track your order from your account dashboard.
            </p>

            {{-- Buttons --}}
            <div class="success-btns">
                <a href="/products" class="success-btn-primary">
                    Continue Shopping
                </a>
                <a href="/orders" class="success-btn-outline">
                    View My Orders
                </a>
            </div>

        </div>
    </div>
</section>

@endsection