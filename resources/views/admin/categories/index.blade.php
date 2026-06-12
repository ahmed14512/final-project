@extends('adminlte::page')

@section('title', 'Categories')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Categories</h1>
        
        <a href="{{ route('admin.categories.create') }}"
           class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Add Category
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
                @forelse($categories as $category)
                <tr>
                    <td>{{ $loop->iteration}}</td>
                    <td>
                        @if(category->$image)
                        <img src="{{asset('storage/'.$category->image)}}" alt="$category->name" width="50" height="50"
                                 class="rounded object-fit-cover">
                        @else
                            <span class="text-muted">No image</span>
                        @endif
                    </td>

                    <td>{{$category->name}}</td>

                    <td>
                       <code> {{$category->slug}}</code>
                    </td>

                    <td>
                        @if($category->status)
                        <span class="badge bg-success">Active</span>
                        @else
                        <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>

                    <td>
                        {{--edit btn--}}
                        <a href="{{route('admin.categories.edit'), $category->idate}}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>

                        {{--delete btn--}}
                        <form action="{{route('admin.categories.destroy')}}" method="POST" style="display: inline-block;"
                              onsubmit="return confirm('Are you sure?')">
                        @csrf 
                        @method('DELETE')
                        <button type="submit"class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> Delete
                        </button>

                        </form>
                    </td>
                </tr>
                
                {{-- Show message if no categories --}}
                
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-3">
                        No categories found.
                        <a href="{{ route('admin.categories.create') }}">
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