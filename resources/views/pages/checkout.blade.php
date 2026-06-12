@extends('layouts.app')

@section('title', 'Checkout - SmartPickz')

@section('styles')
    <link href="{{ asset('css/checkout.css') }}" rel="stylesheet">
    <link href="{{ asset('css/order-summary.css') }}" rel="stylesheet">
@endsection

@section('content')

{{------------------------ Step indicator ---------------------}}
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


            {{------------------------ shipping form SAVED ---------------------}}
            <div class="checkout-main">
                
                {{-- @auth --}}
                <div class="checkout-card">
                    <h2 class="checkout-card-title">Shipping Address</h2>

                    <div class="address-list">
                        
                    {{-- Address 1 --}}
                        <label class="address-card">
                            <input type="radio" name="saved_address" value="1" checked class="address-radio">
                            <div class="address-card-body">
                                <div class="address-card-info">
                                    <p class="address-name">John Silva</p>
                                    <p class="address-text">
                                        123 Main Street, Colombo 03, Western Province
                                    </p>
                                    <p class="address-phone">+94 77 123 4567</p>
                                </div>
                                <button type="button" class="address-edit-btn" onclick="editAddress(1)">
                                    <img src="{{ asset('images/icons/edit.svg') }}" alt="edit" class="address-edit-icon">
                                </button>
                            </div>
                        </label>

                        {{-- Address 2 --}}
                        <label class="address-card">
                            <input type="radio" name="saved_address" value="2" class="address-radio">
                            <div class="address-card-body">
                                <div class="address-card-info">
                                    <p class="address-name">John Silva</p>
                                    <p class="address-text">
                                        45 Galle Road, Dehiwala, Western Province
                                    </p>
                                    <p class="address-phone">+94 77 123 4567</p>
                                </div>
                                <button type="button" class="address-edit-btn" onclick="editAddress(2)">
                                    <img src="{{ asset('images/icons/edit.svg') }}"  alt="edit" class="address-edit-icon">
                                </button>
                            </div>
                        </label>

                        <label class="address-add-new" onclick="toggleNewAddress()">
                            <div class="address-add-icon">+</div>
                            <span class="address-add-text">Add New Address</span>
                        </label>

                    </div>
                </div>
                {{-- @endauth --}}

                <div class="checkout-card" id="newAddressForm">
                    <h2 class="checkout-card-title">Contact Information</h2>

                    <form id="shippingForm">

                        {{-- Row 1: First + Last name --}}
                        <div class="form-row">
                            <div class="form-field">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-input" placeholder="John" required>
                            </div>
                            <div class="form-field">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-input"  placeholder="Silva" required>
                            </div>
                        </div>

                        {{-- Row 2: Phone + Email --}}
                        <div class="form-row">
                            <div class="form-field">
                                <label class="form-label">Phone Number</label>
                                <div class="phone-input-wrap">
                                    <div class="phone-prefix">
                                        <img src="{{ asset('images/icons/flag.svg') }}" alt="LK" class="flag-icon">
                                        <span>+94</span>
                                    </div>
                                    <input type="tel" class="form-input phone-field" placeholder="77 123 4567" required>
                                </div>
                            </div>
                            <div class="form-field">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-input" placeholder="you@example.com" required>
                            </div>
                        </div>

                        <hr class="form-divider">
                        <h2 class="checkout-card-title">Delivery Address</h2>

                        {{-- Row 3: City + Zip --}}
                        <div class="form-row">
                            <div class="form-field">
                                <label class="form-label">City</label>
                                <input type="text" class="form-input" placeholder="Colombo" required>
                            </div>
                            <div class="form-field">
                                <label class="form-label">Zip Code</label>
                                <input type="text" class="form-input" placeholder="00300" required>
                            </div>
                        </div>

                        {{-- Row 4: Street address full width --}}
                        <div class="form-field">
                            <label class="form-label">Street Address</label>
                            <input type="text" class="form-input" placeholder="123 Main Street, Apartment 4B" required>
                        </div>

                        {{-- Default address checkbox --}}
                        <label class="default-address-check">
                            <input type="checkbox" name="set_default">
                            <span>Set as default shipping address</span>
                        </label>

                    </form>
                </div>

                

            </div>
            {{-- Order Summary --}}
            @include('partials.order-summary')

             {{-- payment btn --}}
                <a href="/payment" class="checkout-next-btn">
                    Go to Payment
                    <img src="{{ asset('images/icons/arrow-right.svg') }}"  alt="next" class="checkout-next-icon">
                </a>
        </div>
    </div>
</section>



@endsection



@section('scripts')
<script>

    // Show/hide new address form
    function toggleNewAddress() {
        const form = document.getElementById('newAddressForm');
        form.classList.toggle('visible');
    }

    // Edit address — for now just shows the form
    function editAddress(id) {
        const form = document.getElementById('newAddressForm');
        form.classList.add('visible');
        // Later: fetch address data and fill the form fields
    }

    // Show login popup if not logged in
    // Uncomment when auth is ready
    // document.addEventListener('DOMContentLoaded', function () {
    //     @guest
    //         openAuthPopup();
    //     @endguest
    // });

</script>
@endsection
