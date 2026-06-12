@extends('adminlte::page')

@section('title', 'Categories')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Add Category</h1>
        
        <a href="{{ route('admin.categories.index') }}"
           class="btn btn-primary">
            <i class="fas fa-arrow-left me-1"></i> back
        </a>
    </div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route ('admin.categories.store') }}" mothod="POST" enctype="multipart/form-data">
            @csrf
        
        {{--------name-------}}
        <div class="mb-3">
            <label class="form-label fw-semibold">
                category Name<span class="text-danger">*</span>
            </label>

            <input  type="text" name="name" 
                    class="form-control @error('name') is-invalid @enderror" 
                    value="{{ old('name') }}" placeholder="e.g. Laptops" required>

            @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Description</label>
            <textarea name="description"
                        class="form-control @error('description') is-invalid @enderror"
                        rows="3"
                        placeholder="Optional description">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        
        </form>
    </div>
</div>
@endsection
