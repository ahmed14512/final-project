@extends('adminlte::page')

@section('title', 'Edit Product')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Edit Product</h1>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Product Name <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $product->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
                </div>

                {{-- SKU --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        SKU <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror"
                        value="{{ old('sku', $product->sku) }}" required>
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
                        <select name="category_id" class="form-select" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            Brand <span class="text-danger">*</span>
                        </label>
                        <select name="brand_id" class="form-select" required>
                            <option value="">Select Brand</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}"
                                    {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Price + Stock --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            Price (Rs.) <span class="text-danger">*</span>
                        </label>
                        <input type="number" name="price" class="form-control"
                            value="{{ old('price', $product->price) }}" min="0" step="0.01" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            Stock <span class="text-danger">*</span>
                        </label>
                        <input type="number" name="stock" class="form-control"
                            value="{{ old('stock', $product->stock) }}" min="0" required>
                    </div>
                </div>

                {{-- Current Main Image --}}
                @if ($product->image)
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Current Main Image
                        </label>
                        <div>
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="100"
                                class="rounded">
                        </div>
                    </div>
                @endif

                {{-- New Main Image --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Change Main Image
                    </label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="text-muted">
                        Leave empty to keep current image.
                    </small>
                </div>

                {{-- Current Thumbnails --}}
                @if ($product->images->count() > 0)
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Current Thumbnails
                        </label>
                        <div class="d-flex gap-2 flex-wrap">
                            @foreach ($product->images as $thumb)
                                <div class="position-relative">
                                    <img src="{{ asset('storage/' . $thumb->image) }}" alt="thumbnail" width="80"
                                        class="rounded border">
                                    <form action="{{ route('admin.products.images.destroy', $thumb->id) }}" method="POST"
                                        style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm position-absolute top-0 end-0"
                                            style="padding:1px 5px;font-size:10px;"
                                            onclick="return confirm('Remove this image?')">
                                            x
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Add More Thumbnails --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Add More Thumbnails
                    </label>
                    <input type="file" name="thumbnails[]" class="form-control" accept="image/*" multiple>
                    <small class="text-muted">
                        Select multiple images to add more.
                    </small>
                </div>

                {{-- Featured + Status --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            Featured on Home Page
                        </label>
                        <select name="is_featured" class="form-select">
                            <option value="0" {{ $product->is_featured == 0 ? 'selected' : '' }}>
                                No
                            </option>
                            <option value="1" {{ $product->is_featured == 1 ? 'selected' : '' }}>
                                Yes
                            </option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select">
                            <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                    </div>
                </div>

                {{-- Buttons --}}
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Update Product
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
