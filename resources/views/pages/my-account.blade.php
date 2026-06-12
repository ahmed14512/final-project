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

            {{--------- side bar ------------}}
            <aside class="account-sidebar">

                <div class="account-welcome">
                    <div>
                        <p class="account-hi">Hi, John</p>
                        <p class="account-tagline">Welcome to SmartPickz</p>
                    </div>
                </div>

                <nav class="account-nav">
                    <a href="#" class="account-nav-item active" onclick="showTab('profile', this)">
                        <img src="{{ asset('images/icons/user.svg') }}"  alt="" class="account-nav-icon">
                        Your Profile
                    </a>
                    <a href="#" class="account-nav-item"  onclick="showTab('orders', this)">
                        <img src="{{ asset('images/icons/order-status.svg') }}"  alt="" class="account-nav-icon">
                        Your Orders
                    </a>
                    <a href="#" class="account-nav-item"  onclick="showTab('addresses', this)">
                        <img src="{{ asset('images/icons/address.svg') }}"  alt="" class="account-nav-icon">
                        Manage Addresses
                    </a>
                    <a href="#" class="account-nav-item" onclick="showTab('wishlist', this)">
                        <img src="{{ asset('images/icons/wishlist-menu.svg') }}"  alt="" class="account-nav-icon">
                        Your Wishlist
                    </a>
                    <form method="POST" action="/logout" class="mt-auto">
                        @csrf
                        <button type="submit" class="account-signout-btn">
                            <img src="{{ asset('images/icons/logout.svg') }}"  alt="" class="account-nav-icon">
                            Sign Out
                        </button>
                    </form>
                </nav>

            </aside>
         

            {{---------- content ------------}}
            <div class="account-content">

                {{------------- profile tab ------------}}
                <div class="account-tab active" id="tab-profile">

                    <div class="account-tab-header">
                        <h2 class="account-tab-title">Your Profile</h2>
                        <p class="account-tab-desc">
                            Update your name, phone number, email,
                            and account password at any time.
                        </p>
                    </div>

                    <div class="profile-fields">

                        {{-- Name --}}
                        <div class="profile-field" id="field-name">
                            <div class="profile-field-view">
                                <div>
                                    <p class="profile-field-label">Name</p>
                                    <p class="profile-field-val" id="val-name">John Silva</p>
                                </div>
                                <button class="profile-edit-btn" onclick="editField('name')">
                                    <img src="{{ asset('images/icons/edit.svg') }}"  alt="edit" class="profile-edit-icon">
                                    Edit
                                </button>
                            </div>
                            <div class="profile-field-form d-none"
                                 id="form-name">
                                <div class="form-row">
                                    <div class="form-field">
                                        <label class="form-label">
                                            First Name
                                        </label>
                                        <input type="text" class="form-input" value="John">
                                    </div>
                                    <div class="form-field">
                                        <label class="form-label">
                                            Last Name
                                        </label>
                                        <input type="text" class="form-input" value="Silva">
                                    </div>
                                </div>
                                <div class="profile-field-btns">
                                    <button class="profile-save-btn"  onclick="saveField('name')">
                                        Save
                                    </button>
                                    <button class="profile-cancel-btn" onclick="cancelField('name')">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>

                        <hr class="profile-field-sep">

                        {{-- Phone --}}
                        <div class="profile-field" id="field-phone">
                            <div class="profile-field-view">
                                <div>
                                    <p class="profile-field-label">
                                        Phone Number
                                    </p>
                                    <p class="profile-field-val" id="val-phone">+94 77 123 4567</p>
                                </div>
                                <button class="profile-edit-btn" onclick="editField('phone')">
                                    <img src="{{ asset('images/icons/edit.svg') }}"  alt="edit" class="profile-edit-icon">
                                    Edit
                                </button>
                            </div>
                            <div class="profile-field-form d-none"  id="form-phone">
                                <div class="form-field">
                                    <label class="form-label">Phone Number</label>
                                    <input type="tel" class="form-input"  value="77 123 4567">
                                </div>
                                <div class="profile-field-btns">
                                    <button class="profile-save-btn" onclick="saveField('phone')">
                                        Save
                                    </button>
                                    <button class="profile-cancel-btn" onclick="cancelField('phone')">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>

                        <hr class="profile-field-sep">

                        {{-- Email --}}
                        <div class="profile-field" id="field-email">
                            <div class="profile-field-view">
                                <div>
                                    <p class="profile-field-label">
                                        Email Address
                                    </p>
                                    <p class="profile-field-val"  id="val-email">john@example.com</p>
                                </div>
                                <button class="profile-edit-btn" onclick="editField('email')">
                                    <img src="{{ asset('images/icons/edit.svg') }}"  alt="edit" class="profile-edit-icon">
                                    Edit
                                </button>
                            </div>
                            <div class="profile-field-form d-none"  id="form-email">
                                <div class="form-field">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-input"  value="john@example.com">
                                </div>
                                <div class="profile-field-btns">
                                    <button class="profile-save-btn"   onclick="saveField('email')">
                                        Save
                                    </button>
                                    <button class="profile-cancel-btn"  onclick="cancelField('email')">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>

                        <hr class="profile-field-sep">

                        {{-- Password --}}
                        <div class="profile-field" id="field-password">
                            <div class="profile-field-view">
                                <div>
                                    <p class="profile-field-label">
                                        Account Password
                                    </p>
                                    <p class="profile-field-val">••••••••</p>
                                </div>
                                <button class="profile-edit-btn"  onclick="editField('password')">
                                    <img src="{{ asset('images/icons/edit.svg') }}"  alt="edit" class="profile-edit-icon">
                                    Edit
                                </button>
                            </div>
                            <div class="profile-field-form d-none"  id="form-password">
                                <div class="form-field">
                                    <label class="form-label">
                                        Current Password
                                    </label>
                                    <input type="password" class="form-input"   placeholder="Enter current password">
                                </div>
                                <div class="form-row">
                                    <div class="form-field">
                                        <label class="form-label">
                                            New Password
                                        </label>
                                        <input type="password" class="form-input"  placeholder="New password">
                                    </div>
                                    <div class="form-field">
                                        <label class="form-label">
                                            Confirm Password
                                        </label>
                                        <input type="password" class="form-input"  placeholder="Confirm password">
                                    </div>
                                </div>
                                <div class="profile-field-btns">
                                    <button class="profile-save-btn"   onclick="saveField('password')">
                                        Save
                                    </button>
                                    <button class="profile-cancel-btn"   onclick="cancelField('password')">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>


                {{---------------- orders tab ----------------}}
                <div class="account-tab d-none" id="tab-orders">

                    <div class="account-tab-header">
                        <h2 class="account-tab-title">Your Orders</h2>
                    </div>

                    <div class="orders-list">

                        <div class="order-card">
                            <div class="order-card-header"  onclick="toggleOrder(this)">
                                <div class="order-header-left">
                                    <span class="order-status-label status-delivered">
                                        Delivered
                                    </span>
                                    <span class="order-number">
                                        #SP-2025-00123
                                    </span>
                                    <span class="order-date">Mar 18, 2025</span>
                                </div>
                                <img src="{{ asset('images/icons/arrow.svg') }}"   alt="expand" class="order-chevron">
                            </div>

                            <div class="order-card-body">
                                <div class="order-dates">
                                    <div class="order-date-item">
                                        <span class="order-date-label">
                                            Order Date
                                        </span>
                                        <span class="order-date-val">
                                            Mar 15, 2025
                                        </span>
                                    </div>
                                    <div class="order-date-item">
                                        <span class="order-date-label">
                                            Delivered Date
                                        </span>
                                        <span class="order-date-val">
                                            Mar 18, 2025
                                        </span>
                                    </div>
                                </div>

                                <hr class="order-sep">

                                <div class="order-tracker">
                                    <div class="tracker-step done">
                                        <div class="tracker-dot"></div>
                                        <span class="tracker-label">
                                            Order Approved
                                        </span>
                                    </div>
                                    <div class="tracker-line done"></div>
                                    <div class="tracker-step done">
                                        <div class="tracker-dot"></div>
                                        <span class="tracker-label">
                                            Processing
                                        </span>
                                    </div>
                                    <div class="tracker-line done"></div>
                                    <div class="tracker-step done">
                                        <div class="tracker-dot"></div>
                                        <span class="tracker-label">
                                            Dispatched
                                        </span>
                                    </div>
                                    <div class="tracker-line done"></div>
                                    <div class="tracker-step done">
                                        <div class="tracker-dot"></div>
                                        <span class="tracker-label">
                                            Delivered
                                        </span>
                                    </div>
                                </div>

                                <hr class="order-sep">

                                <div class="order-products">
                                    <div class="order-product-item">
                                        <div class="order-product-img-wrap">
                                            <img src="{{ asset('images/products/product-1.jpg') }}"  alt="product"  class="order-product-img">
                                        </div>
                                        <div class="order-product-info">
                                            <p class="order-product-name">
                                                ProBook Laptop 15 inch Intel i7
                                            </p>
                                            <p class="order-product-sku">
                                                SKU: SP-001234
                                            </p>
                                            <p class="order-product-price">
                                                Rs. 89,900
                                            </p>
                                        </div>
                                        <button class="add-to-cart-btn">
                                            <img src="{{ asset('images/icons/cart-btn.svg') }}"  alt="cart"  class="cart-btn-icon">
                                            <span>Add to Cart</span>
                                        </button>
                                    </div>
                                </div>

                                <hr class="order-sep">

                                <div class="order-summary-mini">
                                    <div class="order-summary-row">
                                        <span>Subtotal</span>
                                        <span>Rs. 89,900</span>
                                    </div>
                                    <div class="order-summary-row">
                                        <span>Shipping</span>
                                        <span>Rs. 350</span>
                                    </div>
                                    <div class="order-summary-row total">
                                        <span>Total</span>
                                        <span>Rs. 90,250</span>
                                    </div>
                                </div>

                                <button class="invoice-btn">
                                    <img src="{{ asset('images/icons/download.svg') }}"  alt="download" class="invoice-icon">
                                    Download Invoice
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

                {{--------------- address -------------}}
                <div class="account-tab d-none" id="tab-addresses">

                    <div class="account-tab-header">
                        <h2 class="account-tab-title">Manage Addresses</h2>
                    </div>

                    <div class="address-list">

                        <div class="address-manage-card">
                            <div class="address-manage-info">
                                <p class="address-name">John Silva</p>
                                <p class="address-text">
                                    123 Main Street, Colombo 03
                                </p>
                                <p class="address-phone">+94 77 123 4567</p>
                                <span class="address-default-badge">
                                    Default
                                </span>
                            </div>
                            <div class="address-manage-actions">
                                <button class="profile-edit-btn">
                                    <img src="{{ asset('images/icons/edit.svg') }}"  alt="edit" class="profile-edit-icon">
                                    Edit
                                </button>
                                <button class="address-delete-btn">
                                    <img src="{{ asset('images/icons/trash.svg') }}"  alt="delete" class="profile-edit-icon">
                                    Delete
                                </button>
                            </div>
                        </div>

                        <button class="address-add-new-btn" onclick="toggleNewAddressForm()">
                            + Add New Address
                        </button>

                        <div class="address-new-form d-none"  id="newAddressFormAccount">
                            <div class="checkout-card">
                                <div class="form-row">
                                    <div class="form-field">
                                        <label class="form-label">
                                            First Name
                                        </label>
                                        <input type="text" class="form-input"   placeholder="John">
                                    </div>
                                    <div class="form-field">
                                        <label class="form-label">
                                            Last Name
                                        </label>
                                        <input type="text" class="form-input"  placeholder="Silva">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-field">
                                        <label class="form-label">City</label>
                                        <input type="text" class="form-input"  placeholder="Colombo">
                                    </div>
                                    <div class="form-field">
                                        <label class="form-label">
                                            Zip Code
                                        </label>
                                        <input type="text" class="form-input"  placeholder="00300">
                                    </div>
                                </div>
                                <div class="form-field">
                                    <label class="form-label">
                                        Street Address
                                    </label>
                                    <input type="text" class="form-input"  placeholder="123 Main Street">
                                </div>
                                <div class="profile-field-btns">
                                    <button class="profile-save-btn">
                                        Save Address
                                    </button>
                                    <button class="profile-cancel-btn"  onclick="toggleNewAddressForm()">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>


                {{---------- wishlist -------------}}
                <div class="account-tab d-none" id="tab-wishlist">

                    <div class="account-tab-header">
                        <h2 class="account-tab-title">Your Wishlist</h2>
                    </div>

                    <div class="wishlist-grid">

                        <div class="wishlist-card">
                            <div class="card-image-wrap">
                                <img src="{{ asset('images/products/product-1.jpg') }}"
                                     alt="product" class="card-img">
                            </div>
                            <div class="wishlist-card-body">
                                <p class="wishlist-product-name">
                                    ProBook Laptop 15 inch Intel i7
                                </p>
                                <div class="price-wrap">
                                    <span class="product-price">
                                        Rs. 89,900
                                    </span>
                                </div>
                                <div class="wishlist-actions">
                                    <button class="add-to-cart-btn">
                                        <img src="{{ asset('images/icons/cart-btn.svg') }}"
                                             alt="cart" class="cart-btn-icon">
                                        <span>Add to Cart</span>
                                    </button>
                                    <button class="wishlist-remove-btn">
                                        <img src="{{ asset('images/icons/trash.svg') }}"
                                             alt="remove"
                                             class="wishlist-remove-icon">
                                    </button>
                                </div>
                            </div>
                        </div>

                        

                    </div>

                </div>

            </div>

        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>

    function showTab(tabId, link) {
        document.querySelectorAll('.account-tab').forEach(function (tab) {
            tab.classList.add('d-none');
        });
        document.querySelectorAll('.account-nav-item').forEach(function (item) {
            item.classList.remove('active');
        });
        document.getElementById('tab-' + tabId).classList.remove('d-none');
        link.classList.add('active');
    }

    function editField(field) {
        document.getElementById('form-' + field).classList.remove('d-none');
        document.getElementById('form-' + field)
                .previousElementSibling.classList.add('d-none');
    }

    function cancelField(field) {
        document.getElementById('form-' + field).classList.add('d-none');
        document.getElementById('form-' + field)
                .previousElementSibling.classList.remove('d-none');
    }

    function saveField(field) {
        cancelField(field);
    }

    function toggleOrder(header) {
        const body    = header.nextElementSibling;
        const chevron = header.querySelector('.order-chevron');
        const isOpen  = body.classList.contains('open');
        body.classList.toggle('open', !isOpen);
        chevron.classList.toggle('open', !isOpen);
    }

    function toggleNewAddressForm() {
        const form = document.getElementById('newAddressFormAccount');
        form.classList.toggle('d-none');
    }

</script>
@endsection