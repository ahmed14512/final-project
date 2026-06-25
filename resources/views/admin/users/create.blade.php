@extends('adminlte::page')

@section('title', 'Add User')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Add User</h1>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                {{-- Name --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Name <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Email <span class="text-danger">*</span>
                    </label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Phone --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}"
                        placeholder="+94 77 123 4567">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-semibold">
                            Role <span class="text-danger">*</span>
                        </label>

                        <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                            <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>
                                Customer
                            </option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                                Admin
                            </option>
                            <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>
                                Staff
                            </option>
                        </select>

                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select">
                            <option value="1">Active</option>
                            <option value="0">Blocked</option>
                        </select>
                    </div>
                </div>

                {{-- Password --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            Password <span class="text-danger">*</span>
                        </label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            Confirm Password <span class="text-danger">*</span>
                        </label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                </div>

                {{-- Buttons --}}
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Save User
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary ms-2">
                    Cancel
                </a>
            </form>
        </div>
    </div>

@endsection

@section('js')
    @include('admin.partials.alerts')
@endsection
