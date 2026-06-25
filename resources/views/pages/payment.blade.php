@extends('layouts.app')

@section('title', 'Payment - SmartPickz')

@section('styles')
    <link href="{{ asset('css/checkout.css') }}" rel="stylesheet">
    <link href="{{ asset('css/order-summary.css') }}" rel="stylesheet">
@endsection

@section('content')

    {{-- --------------- Step indicator --------------- --}}
    <section class="checkout-steps-bar">
        <div class="container">
            <div class="checkout-steps">
                <div class="checkout-step done">
                    <span class="step-number">✓</span>
                    <span class="step-label">Shipping</span>
                </div>
                <div class="checkout-step-line active"></div>
                <div class="checkout-step active">
                    <span class="step-number">2</span>
                    <span class="step-label">Payment</span>
                </div>
                <div class="checkout-step-line"></div>
                <div class="checkout-step">
                    <span class="step-number">3</span>
                    <span class="step-label">Done</span>
                </div>
            </div>
        </div>
    </section>

    <section class="checkout-section">
        <div class="container">
            <div class="checkout-layout">

                <div class="checkout-main">
                    <div class="checkout-card">
                        <h2 class="checkout-card-title">Payment Method</h2>

                        <div class="payment-options">

                            {{-- Visa --}}
                            <label class="payment-option">
                                <input type="radio" name="payment_method" value="visa" checked>
                                <div class="payment-option-body">
                                    <img src="{{ asset('images/icons/visa.svg') }}" alt="Visa" class="payment-logo">
                                    <span>Visa Card</span>
                                </div>
                            </label>

                            {{-- Mastercard --}}
                            <label class="payment-option">
                                <input type="radio" name="payment_method" value="mastercard">
                                <div class="payment-option-body">
                                    <img src="{{ asset('images/icons/master.svg') }}" alt="Mastercard" class="payment-logo">
                                    <span>Mastercard</span>
                                </div>
                            </label>

                            {{-- Apple Pay --}}
                            <label class="payment-option">
                                <input type="radio" name="payment_method" value="applepay">
                                <div class="payment-option-body">
                                    <img src="{{ asset('images/icons/applepay.svg') }}" alt="Apple Pay"
                                        class="payment-logo">
                                    <span>Apple Pay</span>
                                </div>
                            </label>

                            {{-- Google Pay --}}
                            <label class="payment-option">
                                <input type="radio" name="payment_method" value="googlepay">
                                <div class="payment-option-body">
                                    <img src="{{ asset('images/icons/gpay.svg') }}" alt="Google Pay" class="payment-logo">
                                    <span>Google Pay</span>
                                </div>
                            </label>

                            {{-- Cash on Delivery --}}
                            <label class="payment-option">
                                <input type="radio" name="payment_method" value="cod">
                                <div class="payment-option-body">
                                    <img src="{{ asset('images/icons/cod.svg') }}" alt="Cash" class="payment-logo">
                                    <span>Cash on Delivery</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                {{-- ───── RIGHT — Order Summary ───── --}}
                @include('partials.order-summary')

                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    <button type="submit" class="checkout-next-btn">
                        Complete Payment
                    </button>
                </form>
            </div>
        </div>
    </section>


@endsection
