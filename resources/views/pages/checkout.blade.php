@extends('layouts.app')

@section('title', 'Checkout - SmartPickz')

@section('styles')
    <link href="{{ asset('css/checkout.css') }}" rel="stylesheet">
    <link href="{{ asset('css/order-summary.css') }}" rel="stylesheet">
@endsection

@section('content')

    {{-- ---------------------- Step indicator ------------------- --}}
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


                {{-- ---------------------- shipping form SAVED ------------------- --}}
                <div class="checkout-main">


                    <div class="checkout-card" id="newAddressForm">
                        <h2 class="checkout-card-title">Contact Information</h2>

                        <form action="{{ route('checkout.saveAddress') }}" method="POST" id="shippingForm">
                            @csrf

                            {{-- @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif --}}

                            {{-- Row 1: First + Last name --}}
                            <div class="form-row">
                                <div class="form-field">
                                    <label class="form-label">First Name</label>
                                    <input type="text" name="first_name"
                                        class="form-input @error('first_name') is-invalid @enderror"
                                        value="{{ old('first_name', $address->first_name ?? '') }}" placeholder="John"
                                        required>

                                    @error('first_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>
                                <div class="form-field">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" name="last_name"
                                        class="form-input @error('first_name') is-invalid @enderror"
                                        value="{{ old('last_name', $address->last_name ?? '') }}" placeholder="Silva"
                                        required>

                                    @error('last_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>
                            </div>

                            {{-- Row 2: Phone + Email --}}
                            <div class="form-row">
                                <div class="form-field">
                                    <label class="form-label">Phone Number</label>
                                    <div class="phone-input-wrap">
                                        <div class="phone-prefix">
                                            <img src="{{ asset('images/icons/flag.svg') }}" alt="LK"
                                                class="flag-icon">
                                            <span>+94</span>
                                        </div>
                                        <input type="tel" name="phone"
                                            class="form-input @error('phone') is-invalid @enderror"
                                            value="{{ old('phone', $address->phone ?? '') }}" placeholder="77 123 4567"
                                            required>

                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-field">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" name="email"
                                        class="form-input @error('email') is-invalid @enderror"
                                        value="{{ old('email', $address->email ?? '') }}" placeholder="you@example.com"
                                        required>

                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <hr class="form-divider">
                            <h2 class="checkout-card-title">Delivery Address</h2>

                            {{-- Row 3: City + Zip --}}
                            <div class="form-row">
                                <div class="form-field">
                                    <label class="form-label">City</label>
                                    <input type="city" name="city"
                                        class="form-input @error('city') is-invalid @enderror"
                                        value="{{ old('city', $address->city ?? '') }}" placeholder="you@example.com"
                                        required>

                                    @error('city')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-field">
                                    <label class="form-label">Zip Code</label>
                                    <input type="text" name="zip_code"
                                        class="form-input @error('zip_code') is-invalid @enderror"
                                        value="{{ old('zip_code', $address->zip_code ?? '') }}"
                                        placeholder="you@example.com" required>

                                    @error('zip_code')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Row 4: Street address full width --}}
                            <div class="form-field">
                                <label class="form-label">Street Address</label>
                                <input type="text" name="street_address"
                                    class="form-input @error('street_address') is-invalid @enderror"
                                    value="{{ old('street_address', $address->street_address ?? '') }}"
                                    placeholder="you@example.com" required>

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
