@extends('adminlte::page')

@section('title', 'Add Product')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Add Product</h1>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
    </div>
@endsection

@section('content')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Product Name <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" placeholder="e.g. Samsung Galaxy S24" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Description
                    </label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Product description">{{ old('description') }}</textarea>
                </div>

                {{-- SKU --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        SKU <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror"
                        value="{{ old('sku') }}" placeholder="e.g. SP-001234" required>
                    @error('sku')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Category + Brand --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            Category <span class="text-danger">*</span>
                        </label>
                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- brands --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            Brand <span class="text-danger">*</span>
                        </label>
                        <select name="brand_id" class="form-select @error('brand_id') is-invalid @enderror" required>
                            <option value="">Select Brand</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Price + Stock --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            Price (Rs.) <span class="text-danger">*</span>
                        </label>
                        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                            value="{{ old('price') }}" placeholder="e.g. 89900" min="0" step="0.01" required>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            Stock <span class="text-danger">*</span>
                        </label>
                        <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror"
                            value="{{ old('stock', 0) }}" min="0" required>
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Main Image --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Main Product Image
                    </label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                        accept="image/*">
                    <small class="text-muted">
                        Main image shown on product cards.
                        Max 2MB.
                    </small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Thumbnail Images --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Thumbnail Images
                    </label>
                    <input type="file" name="thumbnails[]" class="form-control" accept="image/*" multiple>
                    <small class="text-muted">
                        Select multiple images.
                        Shown below main image on product page.
                    </small>
                </div>

                {{-- Featured + Status --}}
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            Featured on Home Page
                        </label>
                        <select name="is_featured" class="form-select">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            Status
                        </label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                {{-- Buttons --}}
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Save Product
                </button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary ms-2">
                    Cancel
                </a>
            </form>
        </div>
    </div>

@endsection

@section('js')
    @include('admin.partials.alerts')
@endsection
