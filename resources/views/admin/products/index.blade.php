@extends('adminlte::page')

@section('title', 'Products')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Products</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Add Product
        </a>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>SKU</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                @forelse($products as $product)
                    <tbody>
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        width="50" height="50" class="rounded object-fit-cover">
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </td>

                            <td>{{ $product->name }}</td>
                            <td><code>{{ $product->sku }}</code></td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->brand->name }}</td>
                            <td>Rs. {{ number_format($product->price) }}</td>

                            <td>
                                @if ($product->stock > 0)
                                    <span class="badge bg-success">
                                        {{ $product->stock }}
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        Out of Stock
                                    </span>
                                @endif
                            </td>

                            <td>
                                @if ($product->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                    style="display:inline-block;" id="delete-product-{{ $product->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger"
                                        onclick="confirmDelete('delete-product-{{ $product->id }}')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted py-3">
                                No products found.
                                <a href="{{ route('admin.products.create') }}">
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
