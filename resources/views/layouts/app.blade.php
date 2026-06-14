<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, inital-scale=1.0">
    <title>@yield('Title', 'Home')</title>

    {{-- CSS --}}
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/authpopup.css') }}" rel="stylesheet">
    @yield('styles')
</head>

<body>

    {{-- top navbar --}}
    <nav class= "navbar navbar-expand-lg sticky-top shadow-left ms-1 bg-white">
        <div class="container">

            {{-- logo --}}
            <a href="#" class="navbar-logo">
                <img src="{{ asset('images/logo.jpg') }}" class="logo" alt="smartPickz">
            </a>


            {{-- Hamburger button --}}
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>



            {{-- Collapsible content --}}
            <div class="collapse navbar-collapse" id="mainNav">
                <div class="nav-inner w-100 d-flex flex-column flex-lg-row align-items-lg-center gap-3 py-3 py-lg-0">

                    {{-- All Categories Button --}}
                    <div class="dropdown">
                        <button class="cat-btn dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="true">
                            <img src="{{ asset('images/icons/all-categories.svg') }}" alt="icon"
                                class="cat-btn-icon">
                            <span>All Categories</span>
                        </button>

                        <ul class="dropdown-menu cat-dropdown-menu">
                            <li>
                                <a class="dropdown-item cat-item" href="/products?category=laptops">
                                    <div class="cat-item-icon-wrap">
                                        <img src="{{ asset('images/icons/laptops.svg') }}" alt="Laptops"
                                            class="cat-item-icon">
                                    </div>
                                    <span>Computers & Laptops</span>
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item cat-item" href="/products?category=laptops">
                                    <div class="cat-item-icon-wrap">
                                        <img src="{{ asset('images/icons/mobile-phones.svg') }}" alt="mobile-phones"
                                            class="cat-item-icon">
                                    </div>
                                    <span>Mobile Phones</span>
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item cat-item" href="/products?category=laptops">
                                    <div class="cat-item-icon-wrap">
                                        <img src="{{ asset('images/icons/home-appliances.svg') }}" alt="home-appliances"
                                            class="cat-item-icon">
                                    </div>
                                    <span>TV & Audio</span>
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item cat-item" href="/products?category=laptops">
                                    <div class="cat-item-icon-wrap">
                                        <img src="{{ asset('images/icons/appliances.svg') }}" alt="appliances"
                                            class="cat-item-icon">
                                    </div>
                                    <span>Refrigerators</span>
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item cat-item" href="/products?category=laptops">
                                    <div class="cat-item-icon-wrap">
                                        <img src="{{ asset('images/icons/washing-machine.svg') }}" alt="washing-machine"
                                            class="cat-item-icon">
                                    </div>
                                    <span>Washing Machines</span>
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item cat-item" href="/products?category=laptops">
                                    <div class="cat-item-icon-wrap">
                                        <img src="{{ asset('images/icons/ac.svg') }}" alt="ac"
                                            class="cat-item-icon">
                                    </div>
                                    <span>Fans & AC</span>
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item cat-item" href="/products?category=laptops">
                                    <div class="cat-item-icon-wrap">
                                        <img src="{{ asset('images/icons/blender.svg') }}" alt="blender"
                                            class="cat-item-icon">
                                    </div>
                                    <span>Mixer Grinders / Blenders</span>
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item cat-item" href="/products?category=laptops">
                                    <div class="cat-item-icon-wrap">
                                        <img src="{{ asset('images/icons/oven.svg') }}" alt="oven"
                                            class="cat-item-icon">
                                    </div>
                                    <span>Microwave Ovens</span>
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item cat-item" href="/products?category=laptops">
                                    <div class="cat-item-icon-wrap">
                                        <img src="{{ asset('images/icons/cooker.svg') }}" alt="cooker"
                                            class="cat-item-icon">
                                    </div>
                                    <span>Rice Cookers</span>
                                </a>
                            </li>
                        </ul>
                    </div>





                    {{-- search --}}
                    <div class="custom-search flex-lg-grow-1">
                        <input type="text" class="form-control-lg search-input" placeholder="Search Products">
                        <button class="btn search-btn">
                            <img src="{{ asset('images/icons/search.svg') }}" alt="search" class="btn-search">
                        </button>
                    </div>

                    {{-- sign-in --}}
                    @auth
                        <div class="dropdown">
                            <button class="user-account dropdown-toggle" data-bs-toggle="dropdown"
                                data-bs-auto-close="true">
                                <img src="{{ asset('images/icons/user.svg') }}" alt="user" class="user-icon">
                                <div class="user-btn-text">
                                    <span class="user-btn-top">Account</span>
                                    <span class="user-btn-btm">{{ Auth::user()->name }}</span>
                                </div>
                            </button>

                            <ul class="dropdown-menu account-dropdown">

                                {{-- User name + sign out --}}
                                <li class="account-dropdown-user">
                                    <div class="account-user-info">
                                        <span class="account-user-name">{{ Auth::user()->name }}</span>
                                        <form method="POST" action="/logout">
                                            @csrf
                                            <button type="submit" class="account-signout-link">
                                                Sign Out
                                            </button>
                                        </form>
                                    </div>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                {{-- Links --}}
                                <li>
                                    <a class="dropdown-item account-menu-item" href="/my-account">
                                        <img src="{{ asset('images/icons/user-menu.svg') }}" alt=""
                                            class="account-menu-icon">
                                        Your Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item account-menu-item" href="/my-account/addresses">
                                        <img src="{{ asset('images/icons/address.svg') }}" alt=""
                                            class="account-menu-icon">
                                        Manage Addresses
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item account-menu-item" href="/my-account/wishlist">
                                        <img src="{{ asset('images/icons/wishlist-menu.svg') }}" alt=""
                                            class="account-menu-icon">
                                        Your Wishlist
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item account-menu-item" href="/my-account/orders">
                                        <img src="{{ asset('images/icons/order-status.svg') }}" alt=""
                                            class="account-menu-icon">
                                        Order Status
                                    </a>
                                </li>

                            </ul>
                        </div>
                    @else
                        <button class="user-account ms-lg-auto" onclick="openAuthPopup()">
                            <img src="{{ asset('images/icons/user.svg') }}" alt="user" class="btn-icon">
                            <div class="btn-text">
                                <span class="btn-top"> Account </span>
                                <span class="btn-btm">Sign in/ Register</span>
                            </div>
                        </button>
                    @endauth

                    {{-- wishlist --}}
                    <button class="wishlist-btn ms-lg-auto">
                        <img src="{{ asset('images/icons/heart.svg') }}" alt="wishlist" class="btn-icon">

                        <div class="btn-text">
                            <span class="btn-top"> Wishlist </span>
                            <a class="btn-btm" href="#">My Items</a>
                        </div>
                    </button>

                    {{-- cart --}}
                    <button class="cart-btn ms-lg-auto">

                        <div class="cart">
                            <img src="{{ asset('images/icons/cart.svg') }}" alt="cart" class="btn-icon">
                            <span class="cart-count" id="cartCount">0</span>
                        </div>

                        <div class="btn-text">
                            <span class="btn-top"> Cart </span>
                            <a class="btn-btm" href="#">Rs.00.00</a>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <nav class="navbar navbar-expand-lg navbar-btm shadow-sm bg-white">
        <div class="container">

            {{-- Hamburger button (shows on mobile) --}}
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- bottom navigation --}}
            <div class="collapse navbar-collapse" id="mainNav">
                <div class="nav-inner w-100 d-flex flex-column flex-lg-row align-items-lg-center gap-3 py-3 py-lg-0">
                    <ul class="navbar-nav me-auto align-items-lg-center gap-1">

                        {{-- All products --}}
                        <li class="nav-item">
                            <a href="#" class="btm-nav-link ps-0 ">All Products </a>
                        </li>

                        {{-- brands --}}
                        <li class="nav-item dropdown">
                            <a href="#" class="btm-nav-link dropdown-toggle" data-bs-toggle="dropdown"
                                data-bs-auto-close="true"> Brands </a>

                            <ul class="dropdown-menu btm-dropdown brands-dropdown-menu">
                                <li>
                                    <a href="#" class="dropdown-item brands-item">
                                        <div class="brand-item-logo-wrap">
                                            <img src="{{ asset('images/brands/samsung.png') }}" alt="samsung"
                                                class="brand-item-logo">
                                        </div>
                                        <span>Samsung</span>
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item brands-item" href="/products?brand=apple">
                                        <div class="brand-item-logo-wrap">
                                            <img src="{{ asset('images/brands/apple.png') }}" alt="Apple"
                                                class="brand-item-logo">
                                        </div>
                                        <span>Apple</span>
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item brands-item" href="/products?brand=sony">
                                        <div class="brand-item-logo-wrap">
                                            <img src="{{ asset('images/brands/hp.png') }}" alt="Sony"
                                                class="brand-item-logo">
                                        </div>
                                        <span>HP</span>
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item brands-item" href="/products?brand=sony">
                                        <div class="brand-item-logo-wrap">
                                            <img src="{{ asset('images/brands/acer.png') }}" alt="acer"
                                                class="brand-item-logo">
                                        </div>
                                        <span>Acer</span>
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item brands-item" href="/products?brand=sony">
                                        <div class="brand-item-logo-wrap">
                                            <img src="{{ asset('images/brands/usha.png') }}" alt="usha"
                                                class="brand-item-logo">
                                        </div>
                                        <span>Usha</span>
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item brands-item" href="/products?brand=sony">
                                        <div class="brand-item-logo-wrap">
                                            <img src="{{ asset('images/brands/dell.png') }}" alt="dell"
                                                class="brand-item-logo">
                                        </div>
                                        <span>Dell</span>
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item brands-item" href="/products?brand=sony">
                                        <div class="brand-item-logo-wrap">
                                            <img src="{{ asset('images/brands/Asus.png') }}" alt="Asus"
                                                class="brand-item-logo">
                                        </div>
                                        <span>Asus</span>
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item brands-item" href="/products?brand=sony">
                                        <div class="brand-item-logo-wrap">
                                            <img src="{{ asset('images/brands/panasonic.png') }}" alt="Asus"
                                                class="brand-item-logo">
                                        </div>
                                        <span>panasonic</span>
                                    </a>
                                </li>




                                <!-- <li><hr class="dropdown-divider"></li>
                               
                                <li>
                                    <a class="dropdown-item brands-view-all" href="/brands">
                                        View All Brands
                                    </a>
                                </li>   -->
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="btm-nav-link">Appliances </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="btm-nav-link">Computers & Tablets </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="btm-nav-link">Mobile Phones </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="btm-nav-link">Audio & Headphones </a>
                        </li>
                    </ul>


                    <div class="d-flex align-items-center">

                        <a href="#" class="btm-nav-action-btn">
                            <img src="{{ asset('images/icons/help.svg') }}" alt="help" class="action-btn-icon">
                            <span>Help Center</span>
                        </a>

                        <div class="action-btn-separator"></div>


                        <a href="#" class="btm-nav-action-btn">
                            <img src="{{ asset('images/icons/order.svg') }}" alt="order-status"
                                class="action-btn-icon">
                            <span>Order Status</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>



    @yield('content')




    {{-- footer --}}
    <footer class="footer">
        <div class="container">
            <div class="row g-4 footer-cols-row">

                {{-- logo --}}
                <div class="col-12 col-lg footer-col col-brand">
                    <a href="#" class="footer-logo">
                        <img src="{{ asset('images/logo.jpg') }}" class="footer-logo-img" alt="logo">
                    </a>
                    <p class="footer-brand-text">SmartPickz is a trusted online destination for the latest electronics,
                        offering a wide range of products including smartphones, laptops, home appliances, and
                        accessories.</p>
                </div>



                {{-- services --}}
                <div class="col-12 col-sm-6 col-lg footer-col">
                    <div class="footer-col-title" onclick="toggleCol(this)">
                        services
                        <button class="footer-col-toggle" aria-label="Toggle">
                            <img src="{{ asset('images/icons/arrow.svg') }}" class="arrow-icon" alt="arrow">
                        </button>
                    </div>

                    <ul class="footer-links">
                        <li><a href="#">Design</a></li>
                        <li><a href="#">Development</a></li>
                        <li><a href="#">Branding</a></li>
                        <li><a href="#">Consulting</a></li>
                    </ul>
                </div>


                {{-- links --}}
                <div class="col-12 col-sm-6 col-lg footer-col">
                    <div class="footer-col-title" onclick="toggleCol(this)">
                        services
                        <button class="footer-col-toggle" aria-label="Toggle">
                            <img src="{{ asset('images/icons/arrow.svg') }}" class="arrow-icon" alt="arrow">
                        </button>
                    </div>

                    <ul class="footer-links">
                        <li><a href="#">Design</a></li>
                        <li><a href="#">Development</a></li>
                        <li><a href="#">Branding</a></li>
                        <li><a href="#">Consulting</a></li>
                    </ul>
                </div>

                {{-- shop --}}
                <div class="col-12 col-sm-6 col-lg footer-col">
                    <div class="footer-col-title" onclick="toggleCol(this)">
                        services
                        <button class="footer-col-toggle" aria-label="Toggle">
                            <img src="{{ asset('images/icons/arrow.svg') }}" class="arrow-icon" alt="arrow">
                        </button>
                    </div>

                    <ul class="footer-links">
                        <li><a href="#">Design</a></li>
                        <li><a href="#">Development</a></li>
                        <li><a href="#">Branding</a></li>
                        <li><a href="#">Consulting</a></li>
                    </ul>
                </div>

                {{-- apps --}}
                <div class="col-6 col-sm-6 col-lg footer-col">
                    <div class="row">
                        <div class="col-12 footer-col-title" onclick="toggleCol(this)">
                            Get this app
                            <button class="footer-col-toggle" aria-label="Toggle">
                                <img src="{{ asset('images/icons/arrow.svg') }}" class="arrow-icon" alt="arrow">
                            </button>
                        </div>


                        <div class="app-image-wrap">
                            <a href="#" class="app-image">
                                <img src="{{ asset('images/gp.png') }}" class="play store" alt="play store">
                            </a>
                            <a href="#" class="app-image">
                                <img src="{{ asset('images/as.png') }}" class="apple store" alt="apple store">
                            </a>
                        </div>

                        <div class="col-12 footer-col-title" onclick="toggleCol(this)">
                            Get this app
                            <button class="footer-col-toggle" aria-label="Toggle">
                                <img src="{{ asset('images/icons/arrow.svg') }}" class="arrow-icon" alt="arrow">
                            </button>
                        </div>


                        <div class="social-media-icons-wrap">
                            <a href="#" class="social-media-icons">
                                <img src="{{ asset('images/icons/fb.svg') }}" alt="play store">
                            </a>

                            <a href="#" class="social-media-icons">
                                <img src="{{ asset('images/icons/insta.svg') }}" alt="play store">
                            </a>

                            <a href="#" class="social-media-icons">
                                <img src="{{ asset('images/icons/linkedin.svg') }}" alt="play store">
                            </a>

                            <a href="#" class="social-media-icons">
                                <img src="{{ asset('images/icons/youtube.svg') }}" alt="play store">
                            </a>

                            <a href="#" class="social-media-icons">
                                <img src="{{ asset('images/icons/x.svg') }}" alt="play store">
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            {{-- footer bottom --}}
            {{-- Payment row --}}
            <div class="footer-payments">
                <div class="d-flex flex-wrap align-items-center justify-content-center gap-4">
                    <div class="pay-chip">
                        <img src="{{ asset('images/icons/visa.svg') }}" alt="Visa" class="pay-logo">
                    </div>
                    <div class="pay-chip">
                        <img src="{{ asset('images/icons/master.svg') }}" alt="Mastercard" class="pay-logo">
                    </div>
                    <div class="pay-chip">
                        <img src="{{ asset('images/icons/paypal.svg') }}" alt="PayPal" class="pay-logo">
                    </div>
                    <div class="pay-chip">
                        <img src="{{ asset('images/icons/amex.svg') }}" alt="Amex" class="pay-logo">
                    </div>
                    <div class="pay-chip">
                        <img src="{{ asset('images/icons/dis.svg') }}" alt="Stripe" class="pay-logo">
                    </div>
                    <div class="pay-chip">
                        <img src="{{ asset('images/icons/applepay.svg') }}" alt="Apple Pay" class="pay-logo">
                    </div>
                    <div class="pay-chip">
                        <img src="{{ asset('images/icons/gpay.svg') }}" alt="Google Pay" class="pay-logo">
                    </div>
                    <div class="pay-chip">
                        <img src="{{ asset('images/icons/mastero.svg') }}" alt="Google Pay" class="pay-logo">
                    </div>
                </div>
            </div>

            <div class="footer- separator"></div>

            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-12 col-md-6">
                        <p class="footer-copy">
                            &copy; {{ date('Y') }} SmartPickz. All rights reserved.
                        </p>
                    </div>
                    <div class="col-12 col-md-6 text-md-end mt-2 mt-md-0">
                        <ul class="footer-legal-links justify-content-md-end">
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms of Service</a></li>
                            <li><a href="#">Returns</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    {{-- Auth Popup --}}
    @include('layouts.auth-popup')



    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script>
        function toggleCol(titleEl) {
            const isMobile = window.innerWidth < 992;
            if (!isMobile) return;

            const col = titleEl.closest('.footer-col');
            const list = col.querySelector('.footer-links, .app-image-wrap');
            const btn = titleEl.querySelector('.footer-col-toggle');

            if (!list) return;

            const isOpen = list.classList.contains('open');
            list.classList.toggle('open', !isOpen);
            btn.classList.toggle('open', !isOpen);
        }
    </script>
    @yield('scripts')
</body>

</html>
