@extends('layouts.app')

@section('title', 'All Products - SmartPickz')

@section('styles')
    <link href="{{ asset('css/products.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection

@section('content')

{{-----------------------------------Banner---------------------------------------}}
<section class="products-banner-section">
    <div class="container">
        <div class="products-banner">
            <img src="{{asset ('images/banners/products-banner.jpg')}}" alt="produtcs-banner" class="products-banner-img">
        </div>
    </div>
</section>

<section class="products-section">
    <div class="container">
        <div class="products-layout">
            
            {{--Filter--}}
            <aside class="filter-sidebar" id="filter-sidebar">
                
                {{--filter header--}}
                <div class="filter-header">
                    <h2 class="filter-title">Filter</h2>
                    <button class="filter-clear-btn" onclick="clearAllFilters()" id="clearFilters">
                        Clear All
                    </button>
                </div>

                {{--filter form--}}
                <form id="filterForm">

                    {{--filter categories--}}
                    <div class="filter-group">
                        <div class="filter-group-title" onclick="toggleFilterGroup(this)">
                            <span>Categories</span>
                            <img src="{{asset ('images/icons/arrow.svg')}}" alt="chevron-down" class="filter-chevron">
                        </div>

                        <div class="filter-group-body">
                            
                            <label class="filter-check">
                                <input type="checkbox" name="category[]" value="Laptops" onchange="applyFilters()">
                                <span class="filter-checklabel">Computers & Laptops</span>
                            </label>

                            <label class="filter-check">
                                <input type="checkbox" name="category[]" value="phones" onchange="applyFilters()">
                                <span class="filter-checklabel">Mobile Phones</span>
                            </label>

                            <label class="filter-check">
                                <input type="checkbox" name="category[]" value="tv" onchange="applyFilters()">
                                <span class="filter-checklabel">TV & Audio</span>
                            </label>

                            <label class="filter-check">
                                <input type="checkbox" name="category[]" value="refrigerators" onchange="applyFilters()">
                                <span class="filter-checklabel">Refrigerators</span>
                            </label>

                            <label class="filter-check">
                                <input type="checkbox" name="category[]" value="fans" onchange="applyFilters()">
                                <span class="filter-checklabel">Fans & AC</span>
                            </label>

                            <label class="filter-check">
                                <input type="checkbox" name="category[]" value="blenders" onchange="applyFilters()">
                                <span class="filter-checklabel">Mixer Grinders</span>
                            </label>

                            <label class="filter-check">
                                <input type="checkbox" name="category[]" value="ovens" onchange="applyFilters()">
                                <span class="filter-checklabel">Microwave Ovens</span>
                            </label>

                            <label class="filter-check">
                                <input type="checkbox" name="category[]" value="cookers" onchange="applyFilters()">
                                <span class="filter-checklabel">Rice Cookers</span>
                            </label>
                        </div>   
                    </div>

                    <div class="filter-group">
                        <div class="filter-group-title" onclick="toggleFilterGroup(this)">
                            <span>Brands</span>
                            <img src="{{asset ('images/icons/arrow.svg')}}" alt="chevron-down" class="filter-chevron">
                        </div>

                        <div class="filter-group-body">
                            
                            <label class="filter-check">
                                <input type="checkbox" name="brands[]" value="samsung" onchange="applyFilters()">
                                <span class="filter-checklabel">Samsung</span>
                            </label>

                            <label class="filter-check">
                                <input type="checkbox" name="brands[]" value="apple" onchange="applyFilters()">
                                <span class="filter-checklabel">Apple</span>
                            </label>

                            <label class="filter-check">
                                <input type="checkbox" name="brands[]" value="hp" onchange="applyFilters()">
                                <span class="filter-checklabel">HP</span>
                            </label>

                            <label class="filter-check">
                                <input type="checkbox" name="brands[]" value="acer" onchange="applyFilters()">
                                <span class="filter-checklabel">Acer</span>
                            </label>

                            <label class="filter-check">
                                <input type="checkbox" name="brands[]" value="usha" onchange="applyFilters()">
                                <span class="filter-checklabel">Usha</span>
                            </label>

                            <label class="filter-check">
                                <input type="checkbox" name="brands[]" value="dell" onchange="applyFilters()">
                                <span class="filter-checklabel">Dell</span>
                            </label>

                            <label class="filter-check">
                                <input type="checkbox" name="brands[]" value="asus" onchange="applyFilters()">
                                <span class="filter-checklabel">Asus</span>
                            </label>

                            <label class="filter-check">
                                <input type="checkbox" name="brands[]" value="panasonic" onchange="applyFilters()">
                                <span class="filter-checklabel">Panasonic</span>
                            </label>
                        </div>   
                    </div>
                </form>
                
            </aside>

            <div class="products-main">
                <div class="products-topbar">
                    <p class="products-count">
                        Showing <span id="productCount">12</span> products
                    </p>
                    <div class="sort-wrap">
                        <label class="sort-label">Sort by</label>
                        <select class="sort-select" id="sortSelect"
                                onchange="applyFilters()">
                            <option value="new">New Arrivals</option>
                            <option value="price-lh">Price: Low to High</option>
                            <option value="price-hl">Price: High to Low</option>
                        </select>
                    </div>
                </div>

            <div class="products-grid" id="productsGrid">
                
               {{--card 1--}}
                <div class="product-card">
                    <div class="card-image-wrap">
                        <img src="{{asset('images/products/product-1.jpg')}}" alt="product" class="card-img">
                    </div>

                    {{--label--}}
                    <!-- <div class="label">
                        <span class="label-new">NEW</span>
                    </div> -->

                    <div class="card-body">
                        
                        {{--price--}}
                        <div class="price-wrap">
                            <span class="product-price">Rs.1490</span>     
                        </div>

                        {{-- produc name --}}
                        <a href="#" class="card-product-name">ProBook Laptop 15 inch Intel i7 16GB RAM 512GB SSD</a>

                        {{-- rating and cart btn --}}
                        <div class="card-footer-row">
                            <!-- <div class="star-rating">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                                <img src="{{ asset('images/icons/star-fill.svg') }}" class="star" alt="star">
                            </div> -->

                            <button class="add-to-cart-btn">
                                <img src="{{ asset('images/icons/cart-btn.svg') }}" alt="cart" class="cart-btn-icon">
                                <span>Add to Cart</span>
                            </button>
                        </div>
                    </div>
                </div>


                {{--card 2 --}}
                <div class="product-card">
                    <div class="card-image-wrap">
                        <img src="{{asset('images/products/product-1.jpg')}}" alt="product" class="card-img">
                    </div>

                    {{--label--}}
                    <div class="label">
                        
                    </div>

                    <div class="card-body">       
                        {{--price--}}
                        <div class="price-wrap">
                            <span class="label-new">NEW</span>
                            <span class="product-price">Rs.1490</span>    
                        </div>

                        {{-- produc name --}}
                        <a href="#" class="card-product-name">ProBook Laptop 15 inch Intel i7 16GB RAM 512GB SSD</a>

                        {{--cart btn --}}
                        <div class="card-footer-row">
                            <button class="add-to-cart-btn">
                                <img src="{{ asset('images/icons/cart-btn.svg') }}" alt="cart" class="cart-btn-icon">
                                <span>Add to Cart</span>
                            </button>
                        </div>
                    </div>
                </div>


                {{--card 3--}}
                <div class="product-card">
                    <div class="card-image-wrap">
                        <img src="{{asset('images/products/product-1.jpg')}}" alt="product" class="card-img">
                    </div>

                    {{--label--}}
                    <div class="label">
                        
                    </div>

                    <div class="card-body">       
                        {{--price--}}
                        <div class="price-wrap">
                            <span class="label-new">NEW</span>
                            <span class="product-price">Rs.1490</span>    
                        </div>

                        {{-- produc name --}}
                        <a href="#" class="card-product-name">ProBook Laptop 15 inch Intel i7 16GB RAM 512GB SSD</a>

                        {{--cart btn --}}
                        <div class="card-footer-row">
                            <button class="add-to-cart-btn">
                                <img src="{{ asset('images/icons/cart-btn.svg') }}" alt="cart" class="cart-btn-icon">
                                <span>Add to Cart</span>
                            </button>
                        </div>
                    </div>
                </div>


                {{--card 4--}}
                <div class="product-card">
                    <div class="card-image-wrap">
                        <img src="{{asset('images/products/product-1.jpg')}}" alt="product" class="card-img">
                    </div>

                    {{--label--}}
                    <div class="label">
                        
                    </div>

                    <div class="card-body">       
                        {{--price--}}
                        <div class="price-wrap">
                            <span class="label-new">NEW</span>
                            <span class="product-price">Rs.1490</span>    
                        </div>

                        {{-- produc name --}}
                        <a href="#" class="card-product-name">ProBook Laptop 15 inch Intel i7 16GB RAM 512GB SSD</a>

                        {{--cart btn --}}
                        <div class="card-footer-row">
                            <button class="add-to-cart-btn">
                                <img src="{{ asset('images/icons/cart-btn.svg') }}" alt="cart" class="cart-btn-icon">
                                <span>Add to Cart</span>
                            </button>
                        </div>
                    </div>
                </div>



                {{--card 5--}}
                <div class="product-card">
                    <div class="card-image-wrap">
                        <img src="{{asset('images/products/product-1.jpg')}}" alt="product" class="card-img">
                    </div>

                    {{--label--}}
                    <div class="label">
                        
                    </div>

                    <div class="card-body">       
                        {{--price--}}
                        <div class="price-wrap">
                            <span class="label-new">NEW</span>
                            <span class="product-price">Rs.1490</span>    
                        </div>

                        {{-- produc name --}}
                        <a href="#" class="card-product-name">ProBook Laptop 15 inch Intel i7 16GB RAM 512GB SSD</a>

                        {{--cart btn --}}
                        <div class="card-footer-row">
                            <button class="add-to-cart-btn">
                                <img src="{{ asset('images/icons/cart-btn.svg') }}" alt="cart" class="cart-btn-icon">
                                <span>Add to Cart</span>
                            </button>
                        </div>
                    </div>
                </div>



                {{--card 6--}}
                <div class="product-card">
                    <div class="card-image-wrap">
                        <img src="{{asset('images/products/product-1.jpg')}}" alt="product" class="card-img">
                    </div>

                    {{--label--}}
                    <div class="label">
                        
                    </div>

                    <div class="card-body">       
                        {{--price--}}
                        <div class="price-wrap">
                            <span class="label-new">NEW</span>
                            <span class="product-price">Rs.1490</span>    
                        </div>

                        {{-- produc name --}}
                        <a href="#" class="card-product-name">ProBook Laptop 15 inch Intel i7 16GB RAM 512GB SSD</a>

                        {{--cart btn --}}
                        <div class="card-footer-row">
                            <button class="add-to-cart-btn">
                                <img src="{{ asset('images/icons/cart-btn.svg') }}" alt="cart" class="cart-btn-icon">
                                <span>Add to Cart</span>
                            </button>
                        </div>
                    </div>
                </div>


                {{--card 7--}}
                <div class="product-card">
                    <div class="card-image-wrap">
                        <img src="{{asset('images/products/product-1.jpg')}}" alt="product" class="card-img">
                    </div>

                    {{--label--}}
                    <div class="label">
                        
                    </div>

                    <div class="card-body">       
                        {{--price--}}
                        <div class="price-wrap">
                            <span class="label-new">NEW</span>
                            <span class="product-price">Rs.1490</span>    
                        </div>

                        {{-- produc name --}}
                        <a href="#" class="card-product-name">ProBook Laptop 15 inch Intel i7 16GB RAM 512GB SSD</a>

                        {{--cart btn --}}
                        <div class="card-footer-row">
                            <button class="add-to-cart-btn">
                                <img src="{{ asset('images/icons/cart-btn.svg') }}" alt="cart" class="cart-btn-icon">
                                <span>Add to Cart</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{------------pagination----------------}}
            <div class="products-pagination">
                    <button class="page-btn page-prev" disabled>
                        <img src="{{ asset('images/icons/arrow-left.svg') }}"
                             alt="prev" class="page-arrow">
                    </button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn">4</button>
                    <button class="page-btn">5</button>
                    <span class="page-dots">...</span>
                    <button class="page-btn">10</button>
                    <button class="page-btn page-next">
                        <img src="{{ asset('images/icons/arrow-right.svg') }}"
                             alt="next" class="page-arrow">
                    </button>
                </div>
            </div>
        </div>
        

    </div>
</section>















@endsection

@section('scripts')
<script>

    // Toggle filter group open/close
    function toggleFilterGroup(titleEl) {
        const body    = titleEl.nextElementSibling;
        const chevron = titleEl.querySelector('.filter-chevron');
        const isOpen  = body.classList.contains('open');
        body.classList.toggle('open', !isOpen);
        chevron.classList.toggle('open', !isOpen);
    }

    // Open all filter groups by default
    document.querySelectorAll('.filter-group-body').forEach(function (body) {
        body.classList.add('open');
    });
    document.querySelectorAll('.filter-chevron').forEach(function (c) {
        c.classList.add('open');
    });

    // Apply filters — in future this will submit
    // to Laravel controller with GET params
    function applyFilters() {
    const checked = document.querySelectorAll(
        '#filterForm input[type="checkbox"]:checked'
    ).length;

    const clearBtn = document.getElementById('clearFilters');

    if (checked > 0) {
        clearBtn.classList.add('visible');
        /* Show button when at least
           one checkbox is checked */
    } else {
        clearBtn.classList.remove('visible');
        /* Hide when nothing is checked */
    }
}

    // Clear all filters
    function clearAllFilters() {
    document.querySelectorAll(
        '#filterForm input[type="checkbox"]'
    ).forEach(function (cb) {
        cb.checked = false;
    });
    document.getElementById('sortSelect').value = 'new';
    document.getElementById('clearFilters').classList.remove('visible');
    /* Remove visible class instead of
       setting display none directly */
}

    // Mobile filter sidebar toggle
    function toggleMobileFilter() {
        document.getElementById('filterSidebar').classList.toggle('open');
    }


    // Pagination click
    document.querySelectorAll('.page-btn:not(.page-prev):not(.page-next)').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.page-btn').forEach(function (b) {
                b.classList.remove('active');
            });
            this.classList.add('active');
        });
    });

</script>
@endsection