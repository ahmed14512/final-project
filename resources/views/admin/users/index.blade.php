@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Users</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Add User
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone ?? 'N/A' }}</td>


                            <td>
                                @if ($user->role === 'admin')
                                    <span class="badge bg-danger">Admin</span>
                                @elseif($user->role === 'staff')
                                    <span class="badge bg-warning">Staff</span>
                                @else
                                    <span class="badge bg-info">Customer</span>
                                @endif
                            </td>

                            <td>
                                @if ($user->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Blocked</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                @if ($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                        style="display:inline-block;" id="delete-user-{{ $user->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="confirmDelete('delete-user-{{ $user->id }}')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-3">
                                No users found.
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
