@extends('adminlte::page')

@section('title', 'Edit Brand')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Edit Brand</h1>
        <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Brand Name <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $brand->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $brand->description) }}</textarea>
                </div>

                {{-- Current image --}}
                @if ($brand->logo)
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Current Logo</label>
                        <div>
                            <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}" width="100"
                                class="rounded">
                        </div>
                    </div>
                @endif

                {{-- New image --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Change Logo</label>
                    <input type="file" name="logo" class="form-control" accept="image/*">
                    <small class="text-muted">
                        Leave empty to keep current image.
                    </small>
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select">
                        <option value="1" {{ $brand->status == 1 ? 'selected' : '' }}>
                            Active
                        </option>
                        <option value="0" {{ $brand->status == 0 ? 'selected' : '' }}>
                            Inactive
                        </option>
                    </select>
                </div>

                {{-- Buttons --}}
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Update Brand
                </button>
                <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary ms-2">
                    Cancel
                </a>

            </form>

        </div>
    </div>
@endsection
