@extends('adminlte::page')

@section('title', 'Categories')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Add Brand</h1>

        <a href="{{ route('admin.brands.index') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left me-1"></i> back
        </a>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- ------name----- --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Brand Name<span class="text-danger">*</span>
                    </label>

                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" placeholder="e.g. Laptops" required>

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Description
                    </label>

                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3"
                        placeholder="Optional description">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                {{-- ------image----- --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Brand logo</label>
                    <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror"
                        accept="image/*">
                    <small class="text-muted">
                        Accepted: jpg, png, jpeg, svg. Max 2MB.
                    </small>

                    @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>

                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Save Brand
                </button>
                <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary ms-2">
                    Cancel
                </a>

            </form>
        </div>
    </div>
@endsection
