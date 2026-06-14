@extends('adminlte::page')

@section('title', 'Brands')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Brands</h1>

        <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Add Brands
        </a>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>#</th>.
                        <th>Image</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($brands as $brand)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($brand->logo)
                                    <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}" width="50"
                                        height="50" class="rounded object-fit-cover">
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </td>

                            <td>{{ $brand->name }}</td>

                            <td>
                                <code> {{ $brand->slug }}</code>
                            </td>

                            <td>
                                @if ($brand->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>

                            <td>
                                {{-- edit btn --}}
                                <a href="{{ route('admin.brands.edit', $brand->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                {{-- delete btn --}}
                                <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST"
                                    style="display:inline-block;" id="delete-brand-{{ $brand->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"class="btn btn-sm btn-danger"
                                        onclick="confirmDelete('delete-brand-{{ $brand->id }}')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>

                                </form>
                            </td>
                        </tr>

                        {{-- Show message if no brand --}}

                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">
                                No brands found.
                                <a href="{{ route('admin.brands.create') }}">
                                    Add one now
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    @include('admin.partials.alerts')
@endsection
