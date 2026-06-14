@extends('adminlte::page')

@section('title', 'Edit Category')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Edit Category</h1>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Category Name <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $category->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $category->description) }}</textarea>
                </div>

                {{-- Current image --}}
                @if ($category->image)
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Current Image</label>
                        <div>
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" width="100"
                                class="rounded">
                        </div>
                    </div>
                @endif

                {{-- New image --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Change Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="text-muted">
                        Leave empty to keep current image.
                    </small>
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select">
                        <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>
                            Active
                        </option>
                        <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>
                            Inactive
                        </option>
                    </select>
                </div>

                {{-- Buttons --}}
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Update Category
                </button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary ms-2">
                    Cancel
                </a>

            </form>

        </div>
    </div>
@endsection
