@extends('layouts.app')

@section('title', 'Checkout - SmartPickz')

@section('styles')
    <link href="{{ asset('css/checkout.css') }}" rel="stylesheet">
    <link href="{{ asset('css/order-summary.css') }}" rel="stylesheet">
@endsection

@section('content')

    {{-- ---------------------- step circle ------------------- --}}
    <section class="checkout-steps-bar">
        <div class="container">
            <div class="checkout-steps">
                <div class="checkout-step active">
                    <span class="step-number">1</span>
                    <span class="step-label">Shipping</span>
                </div>


                <div class="checkout-step-line"></div>


                <div class="checkout-step">
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


                {{-- ---------------------- address ------------------- --}}
                <div class="checkout-main">


                    <div class="checkout-card" id="newAddressForm">
                        <h2 class="checkout-card-title">Contact Information</h2>

                        <form action="{{ route('checkout.saveAddress') }}" method="POST" id="shippingForm">
                            @csrf

                            {{-- naem --}}
                            <div class="form-field">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-input @error('name') is-invalid @enderror"
                                    value="{{ old('name', $address->name ?? ($user->name ?? '')) }}"
                                    placeholder="John Silva" required>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Phone + Email --}}
                            <div class="form-row">
                                <div class="form-field">
                                    <label class="form-label">Phone Number</label>
                                    <div class="phone-input-wrap">
                                        <input type="tel" name="phone"
                                            class="form-input @error('phone') is-invalid @enderror"
                                            value="{{ old('phone', $user->phone ?? '') }}" placeholder="771234567">
                                    </div>
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-field">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email"
                                        class="form-input @error('email') is-invalid @enderror"
                                        value="{{ old('email', $user->email ?? '') }}" placeholder="you@example.com"
                                        required>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <hr class="form-divider">
                            <h2 class="checkout-card-title">Delivery Address</h2>

                            {{-- city and zip --}}
                            <div class="form-row">
                                <div class="form-field">
                                    <label class="form-label">City</label>
                                    <input type="city" name="city"
                                        class="form-input @error('city') is-invalid @enderror"
                                        value="{{ old('city', $address->city ?? '') }}" placeholder="colombo" required>

                                    @error('city')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-field">
                                    <label class="form-label">Zip Code</label>
                                    <input type="text" name="zip_code"
                                        class="form-input @error('zip_code') is-invalid @enderror"
                                        value="{{ old('zip_code', $address->zip_code ?? '') }}" placeholder="00300"
                                        required>

                                    @error('zip_code')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Street addressh --}}
                            <div class="form-field">
                                <label class="form-label">Street Address</label>
                                <input type="text" name="street_address"
                                    class="form-input @error('street_address') is-invalid @enderror"
                                    value="{{ old('street_address', $address->street_address ?? '') }}"
                                    placeholder="123, Main street" required>

                                @error('street_address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- ----buttons----- --}}
                            <div class="checkout-btn-row">
                                <a href="/cart" class="checkout-back-btn">
                                    <img src="{{ asset('images/icons/arrow-left.svg') }}" alt="back"
                                        class="checkout-next-icon">
                                    Cart
                                </a>
                                <button type="submit" class="checkout-next-btn">
                                    {{ $address ? 'Save & Continue' : 'Continue' }} to Payment
                                    <img src="{{ asset('images/icons/arrow-right.svg') }}" alt="next"
                                        class="checkout-next-icon">
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
                {{-- Order Summary --}}
                @include('partials.order-summary')

            </div>
        </div>
    </section>



@endsection
