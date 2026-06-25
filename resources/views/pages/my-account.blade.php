@extends('layouts.app')

@section('title', 'My Account - SmartPickz')

@section('styles')
    <link href="{{ asset('css/my-account.css') }}" rel="stylesheet">
    <link href="{{ asset('css/checkout.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection

@section('content')
    <section class="account-section">
        <div class="container">
            <div class="account-layout">

                {{-- ------- side bar ---------- --}}
                <aside class="account-sidebar">

                    <div class="account-welcome">
                        <div>
                            <p class="account-hi">Hi, {{ $user->name }}</p>
                            <p class="account-tagline">Welcome to SmartPickz</p>
                        </div>
                    </div>

                    <nav class="account-nav">
                        <a href="#" class="account-nav-item active" onclick="showTab('profile', this)">
                            <img src="{{ asset('images/icons/user.svg') }}" alt="" class="account-nav-icon">
                            Your Profile
                        </a>
                        <a href="#" class="account-nav-item" onclick="showTab('orders', this)">
                            <img src="{{ asset('images/icons/order-status.svg') }}" alt="" class="account-nav-icon">
                            Your Orders
                        </a>
                        <form method="POST" action="/logout" class="mt-auto">
                            @csrf
                            <button type="submit" class="account-signout-btn">
                                <img src="{{ asset('images/icons/logout.svg') }}" alt="" class="account-nav-icon">
                                Sign Out
                            </button>
                        </form>
                    </nav>

                </aside>


                {{-- -------- content ---------- --}}
                <div class="account-content">

                    {{-- ----------- profile tab ---------- --}}
                    <div class="account-tab active" id="tab-profile">

                        <div class="account-tab-header">
                            <h2 class="account-tab-title">Your Profile</h2>
                            <p class="account-tab-desc">
                                Update your name, phone number, email, address,
                                and account password at any time.
                            </p>
                        </div>

                        {{-- ───── Section 2 — Shipping Address ───── --}}
                        <form action="{{ route('account.saveAddress') }}" method="POST" class="profile-fields">
                            @csrf

                            <h3 class="pw-title">Shipping Address</h3>

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
                                        class="form-input @error('last_name') is-invalid @enderror"
                                        value="{{ old('last_name', $address->last_name ?? '') }}" placeholder="Silva"
                                        required>
                                    @error('last_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

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
                                            value="{{ old('phone', $user->phone) }}" placeholder="77 123 4567">
                                    </div>
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-field">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email"
                                        class="form-input @error('email') is-invalid @enderror"
                                        value="{{ old('email', $address->email ?? '') }}" placeholder="you@example.com"
                                        required>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-field">
                                    <label class="form-label">City</label>
                                    <input type="text" name="city"
                                        class="form-input @error('city') is-invalid @enderror"
                                        value="{{ old('city', $address->city ?? '') }}" placeholder="Colombo" required>
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

                            <div class="form-field">
                                <label class="form-label">Street Address</label>
                                <input type="text" name="street_address"
                                    class="form-input @error('street_address') is-invalid @enderror"
                                    value="{{ old('street_address', $address->street_address ?? '') }}"
                                    placeholder="123 Main Street" required>
                                @error('street_address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="profile-field-btns">
                                <button type="submit" class="profile-save-btn">
                                    Save
                                </button>
                                <button type="reset" class="profile-cancel-btn">
                                    Reset
                                </button>
                            </div>

                        </form>

                        <hr class="profile-field-sep">

                        {{-- ───── Section 3 — Change Password ───── --}}
                        <form action="{{ route('account.updatePassword') }}" method="POST" class="profile-fields">
                            @csrf

                            <h3 class="pw-title">Change Password</h3>
                            <small class="text-muted mb-2 d-block">
                                Leave blank if you don't want to change your password.
                            </small>

                            <div class="form-field">
                                <label class="form-label">Current Password</label>
                                <input type="password" name="current_password"
                                    class="form-input @error('current_password') is-invalid @enderror"
                                    placeholder="Enter current password">
                                @error('current_password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-row">
                                <div class="form-field">
                                    <label class="form-label">New Password</label>
                                    <input type="password" name="new_password"
                                        class="form-input @error('new_password') is-invalid @enderror"
                                        placeholder="Enter new password">
                                    @error('new_password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-field">
                                    <label class="form-label">Confirm New Password</label>
                                    <input type="password" name="new_password_confirmation" class="form-input"
                                        placeholder="Confirm new password">
                                </div>
                            </div>

                            <div class="profile-field-btns">
                                <button type="submit" class="profile-save-btn">
                                    Save
                                </button>
                                <button type="reset" class="profile-cancel-btn">
                                    Reset
                                </button>
                            </div>

                        </form>

                    </div>
                    {{-- END tab-profile --}}



                    {{-- -------------- orders tab -------------- --}}
                    <div class="account-tab d-none" id="tab-orders">

                        <div class="account-tab-header">
                            <h2 class="account-tab-title">Your Orders</h2>
                        </div>

                        <div class="orders-list">
                            @forelse($orders as $order)
                                <div class="order-card">
                                    <div class="order-card-header" onclick="toggleOrder(this)">
                                        <div class="order-header-left">
                                            @php
                                                $statusClass = match ($order->status) {
                                                    'pending' => 'status-pending',
                                                    'processing' => 'status-processing',
                                                    'dispatched' => 'status-dispatched',
                                                    'delivered' => 'status-delivered',
                                                    default => 'status-pending',
                                                };
                                            @endphp
                                            <span class="order-status-label {{ $statusClass }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                            <span class="order-number">
                                                #{{ $order->order_number }}
                                            </span>
                                            <span class="order-date"> {{ $order->created_at->format('M d, Y') }}</span>
                                        </div>
                                        <img src="{{ asset('images/icons/arrow.svg') }}" alt="expand"
                                            class="order-chevron">
                                    </div>

                                    <div class="order-card-body">
                                        <div class="order-dates">
                                            <div class="order-date-item">
                                                <span class="order-date-label">
                                                    Order Date
                                                </span>
                                                <span class="order-date-val">
                                                    {{ $order->created_at->format('M d, Y') }}
                                                </span>
                                            </div>
                                        </div>

                                        <hr class="order-sep">

                                        <div class="order-products">
                                            @foreach ($order->items as $item)
                                                <div class="order-product-item">
                                                    <div class="order-product-img-wrap">
                                                        @if ($item->image)
                                                            <img src="{{ asset('storage/' . $item->image) }}"
                                                                alt="{{ $item->product_name }}"
                                                                class="order-product-img">
                                                        @else
                                                            <img src="{{ asset('images/products/product-1.jpg') }}"
                                                                alt="product" class="order-product-img">
                                                        @endif
                                                    </div>
                                                    <div class="order-product-info">
                                                        @if ($item->product)
                                                            <a href="{{ route('products.show', $item->product->id) }}"
                                                                class="order-product-name order-product-name-link">
                                                                {{ $item->product_name }}
                                                            </a>
                                                        @else
                                                            <p class="order-product-name">
                                                                {{ $item->product_name }}
                                                            </p>
                                                        @endif
                                                        <p class="order-product-sku">
                                                            Qty: {{ $item->quantity }}
                                                        </p>
                                                        <p class="order-product-price">
                                                            Rs. {{ number_format($item->price) }}
                                                        </p>
                                                    </div>

                                                    @if ($item->product)
                                                        <form action="{{ route('cart.add') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="product_id"
                                                                value="{{ $item->product->id }}">
                                                            <button type="submit" class="add-to-cart-btn">
                                                                <img src="{{ asset('images/icons/cart-btn.svg') }}"
                                                                    alt="cart" class="cart-btn-icon">
                                                                <span>Add to Cart</span>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>

                                        <hr class="order-sep">

                                        <div class="order-summary-mini">
                                            <div class="order-summary-row">
                                                <span>Subtotal</span>
                                                <span>Rs. {{ number_format($order->subtotal) }}</span>
                                            </div>
                                            <div class="order-summary-row">
                                                <span>Shipping</span>
                                                <span>Rs. {{ number_format($order->shipping) }}</span>
                                            </div>
                                            <div class="order-summary-row total">
                                                <span>Total</span>
                                                <span>Rs. {{ number_format($order->total) }}</span>
                                            </div>
                                        </div>

                                        <button class="invoice-btn">
                                            <img src="{{ asset('images/icons/download.svg') }}" alt="download"
                                                class="invoice-icon">
                                            Download Invoice
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center text-muted py-5">
                                    <p>You haven't placed any orders yet.</p>
                                    <a href="{{ route('products.index') }}" class="btn btn-primary">
                                        Start Shopping
                                    </a>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    {{-- END tab-orders --}}


                    {{-- ------------- address ----------- --}}
                    <div class="account-tab d-none" id="tab-addresses">

                        <div class="account-tab-header">
                            <h2 class="account-tab-title">Manage Addresses</h2>
                        </div>

                        <div class="address-list">

                            @if ($address)
                                <div class="address-manage-card" id="addressDisplay">
                                    <div class="address-manage-info">
                                        <p class="address-name">{{ $address->first_name }} {{ $address->last_name }}</p>
                                        <p class="address-text">
                                            {{ $address->street_address }}, {{ $address->city }},
                                            {{ $address->zip_code }}
                                        </p>
                                        <p class="address-phone">{{ $address->phone }}</p>
                                    </div>
                                    <div class="address-manage-actions">
                                        <button type="button" class="profile-edit-btn" onclick="toggleAddressForm()">
                                            <img src="{{ asset('images/icons/edit.svg') }}" alt="edit"
                                                class="profile-edit-icon">
                                            Edit
                                        </button>

                                    </div>
                                </div>
                            @else
                                <button type="button" class="address-add-new-btn" onclick="toggleAddressForm()">
                                    + Add New Address
                                </button>
                            @endif

                            <div class="address-new-form {{ $address ? 'd-none' : '' }}" id="addressFormWrap">
                                <form action="{{ route('account.saveAddress') }}" method="POST">
                                    @csrf
                                    <div class="checkout-card">

                                        <div class="form-row">
                                            <div class="form-field">
                                                <label class="form-label">First Name</label>
                                                <input type="text" name="first_name"
                                                    class="form-input @error('first_name') is-invalid @enderror"
                                                    value="{{ old('first_name', $address->first_name ?? '') }}"
                                                    placeholder="John" required>
                                                @error('first_name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-field">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" name="last_name"
                                                    class="form-input @error('last_name') is-invalid @enderror"
                                                    value="{{ old('last_name', $address->last_name ?? '') }}"
                                                    placeholder="Silva" required>
                                                @error('last_name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-field">
                                                <label class="form-label">Phone</label>
                                                <input type="tel" name="phone"
                                                    class="form-input @error('phone') is-invalid @enderror"
                                                    value="{{ old('phone', $address->phone ?? '') }}"
                                                    placeholder="77 123 4567" required>
                                                @error('phone')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-field">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email"
                                                    class="form-input @error('email') is-invalid @enderror"
                                                    value="{{ old('email', $address->email ?? '') }}"
                                                    placeholder="you@example.com" required>
                                                @error('email')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-field">
                                                <label class="form-label">City</label>
                                                <input type="text" name="city"
                                                    class="form-input @error('city') is-invalid @enderror"
                                                    value="{{ old('city', $address->city ?? '') }}" placeholder="Colombo"
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
                                                    placeholder="00300" required>
                                                @error('zip_code')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-field">
                                            <label class="form-label">Street Address</label>
                                            <input type="text" name="street_address"
                                                class="form-input @error('street_address') is-invalid @enderror"
                                                value="{{ old('street_address', $address->street_address ?? '') }}"
                                                placeholder="123 Main Street" required>
                                            @error('street_address')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="profile-field-btns">
                                            <button type="submit" class="profile-save-btn">
                                                Save Address
                                            </button>
                                            @if ($address)
                                                <button type="button" class="profile-cancel-btn"
                                                    onclick="toggleAddressForm()">
                                                    Cancel
                                                </button>
                                            @endif
                                        </div>

                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
                    {{-- END tab-addresses --}}


                    {{-- <div class="account-tab d-none" id="tab-wishlist">
                        ...wishlist content stays commented out, unchanged...
                    </div> --}}

                </div>
                {{-- END account-content --}}

            </div>
            {{-- END account-layout --}}

        </div>
        {{-- END container --}}

    </section>

@endsection



@section('scripts')
    <script>
        function showTab(tabId, link) {
            document.querySelectorAll('.account-tab').forEach(function(tab) {
                tab.classList.add('d-none');
            });
            document.querySelectorAll('.account-nav-item').forEach(function(item) {
                item.classList.remove('active');
            });
            document.getElementById('tab-' + tabId).classList.remove('d-none');
            link.classList.add('active');
        }

        function toggleOrder(header) {
            const body = header.nextElementSibling;
            const chevron = header.querySelector('.order-chevron');
            const isOpen = body.classList.contains('open');
            body.classList.toggle('open', !isOpen);
            chevron.classList.toggle('open', !isOpen);
        }

        function toggleAddressForm() {
            const form = document.getElementById('addressFormWrap');
            form.classList.toggle('d-none');
        }
    </script>
@endsection
