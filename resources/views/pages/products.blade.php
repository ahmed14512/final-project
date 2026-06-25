@extends('layouts.app')

@section('title', 'All Products - SmartPickz')

@section('styles')
    <link href="{{ asset('css/products.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection

@section('content')

    {{-- Banner --}}
    <section class="products-banner-section">
        <div class="container">
            <div class="products-banner">
                <img src="{{ asset('images/banners/products-banner.jpg') }}" alt="products-banner" class="products-banner-img">
            </div>
        </div>
    </section>

    <section class="products-section">
        <div class="container">
            <div class="products-layout">

                {{-- left — Filter sidebar --}}
                <aside class="filter-sidebar" id="filter-sidebar">

                    <div class="filter-header">
                        <h2 class="filter-title">Filter</h2>
                        <a href="{{ route('products.index') }}">
                            <button type="button" class="filter-clear-btn" id="clearFilters">
                                Clear All
                            </button>
                        </a>
                    </div>

                    <form id="filterForm" method="GET">

                        {{-- Categories --}}
                        <div class="filter-group">
                            <div class="filter-group-title" onclick="toggleFilterGroup(this)">
                                <span>Categories</span>
                                <img src="{{ asset('images/icons/arrow.svg') }}" alt="chevron" class="filter-chevron">
                            </div>
                            <div class="filter-group-body">
                                @foreach ($categories as $category)
                                    <label class="filter-check">
                                        <input type="checkbox" name="category[]" value="{{ $category->id }}"
                                            {{ in_array($category->id, request('category', [])) ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        <span class="filter-checklabel">{{ $category->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Brands --}}
                        <div class="filter-group">
                            <div class="filter-group-title" onclick="toggleFilterGroup(this)">
                                <span>Brands</span>
                                <img src="{{ asset('images/icons/arrow.svg') }}" alt="chevron" class="filter-chevron">
                            </div>
                            <div class="filter-group-body">
                                @foreach ($brands as $brand)
                                    <label class="filter-check">
                                        <input type="checkbox" name="brand[]" value="{{ $brand->id }}"
                                            {{ in_array($brand->id, request('brand', [])) ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        <span class="filter-checklabel">{{ $brand->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <input type="hidden" name="sort" id="sortHiddenInput" value="{{ request('sort', 'new') }}">

                    </form>
                </aside>
                {{-- end filter-sidebar --}}

                {{-- RIGHT — Products main --}}
                <div class="products-main">

                    {{-- count + sort --}}
                    <div class="products-topbar">
                        <p class="products-count">
                            Showing {{ $products->count() }} of {{ $products->total() }} products
                        </p>
                        <div class="sort-wrap">
                            <label class="sort-label">Sort by</label>
                            <select class="sort-select" id="sortSelect"
                                onchange="document.getElementById('sortHiddenInput').value = this.value; document.getElementById('filterForm').submit();">
                                <option value="new" {{ request('sort', 'new') == 'new' ? 'selected' : '' }}>
                                    New Arrivals
                                </option>
                                <option value="price-lh" {{ request('sort') == 'price-lh' ? 'selected' : '' }}>
                                    Price: Low to High
                                </option>
                                <option value="price-hl" {{ request('sort') == 'price-hl' ? 'selected' : '' }}>
                                    Price: High to Low
                                </option>
                            </select>
                        </div>
                    </div>

                    {{-- Product Grid --}}
                    <div class="products-grid" id="productsGrid">

                        @forelse($products as $product)
                            <div class="product-card {{ !$product->is_new ? 'no-labels' : '' }}">
                                <div class="card-image-wrap">
                                    <a href="{{ route('products.show', $product->id) }}">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                            class="card-img">
                                    </a>
                                    @if ($product->is_new)
                                        <span class="label-new">NEW</span>
                                    @endif
                                </div>

                                <div class="card-body">
                                    <div class="price-wrap">
                                        <span class="product-price">
                                            Rs. {{ $product->price }}
                                        </span>
                                    </div>

                                    <a href="{{ route('products.show', $product->id) }}" class="card-product-name">
                                        {{ $product->name }}
                                    </a>

                                    <div class="card-footer-row">
                                        <form action="{{ route('cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit" class="add-to-cart-btn">
                                                <img src="{{ asset('images/icons/cart-btn.svg') }}" alt="cart"
                                                    class="cart-btn-icon">
                                                <span>Add to Cart</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-muted py-5">
                                No products found.
                            </p>
                        @endforelse

                    </div>
                    {{-- END products-grid --}}

                    {{-- Pagination --}}
                    <div class="products-pagination">
                        {{ $products->links() }}
                    </div>

                </div>

            </div>
            {{-- END products-layout --}}
        </div>
    </section>

@endsection

@section('scripts')
    <script>
        function toggleFilterGroup(titleEl) {
            const body = titleEl.nextElementSibling;
            const chevron = titleEl.querySelector('.filter-chevron');
            const isOpen = body.classList.contains('open');
            body.classList.toggle('open', !isOpen);
            chevron.classList.toggle('open', !isOpen);
        }

        document.querySelectorAll('.filter-group-body').forEach(function(body) {
            body.classList.add('open');
        });
        document.querySelectorAll('.filter-chevron').forEach(function(c) {
            c.classList.add('open');
        });

        function toggleMobileFilter() {
            document.getElementById('filterSidebar').classList.toggle('open');
        }
    </script>
@endsection
