@extends('adminlte::page')

@section('title', 'Customer - ' . $customer->name)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>{{ $customer->name }}</h1>
        <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
    </div>
@endsection

@section('content')

    <div class="row">

        {{-- Customer info --}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Customer Details</h3>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $customer->name }}</p>
                    <p><strong>Email:</strong> {{ $customer->email }}</p>
                    <p><strong>Phone:</strong> {{ $customer->phone ?? 'N/A' }}</p>
                    <p><strong>Joined:</strong> {{ $customer->created_at->format('M d, Y') }}</p>
                    <p>
                        <strong>Status:</strong>
                        @if ($customer->status)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Blocked</span>
                        @endif
                    </p>
                </div>
            </div>

            <div class="card">
                <div class="card-body text-center">
                    <h3 class="mb-0">{{ $orders->count() }}</h3>
                    <p class="text-muted">Total Orders</p>
                    <hr>
                    <h3 class="mb-0">Rs. {{ number_format($orders->sum('total')) }}</h3>
                    <p class="text-muted">Total Spent</p>
                </div>
            </div>
        </div>

        {{-- Order history --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Order History</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Date</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td>#{{ $order->order_number }}</td>
                                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                                    <td>{{ $order->items->count() }}</td>
                                    <td>Rs. {{ number_format($order->total) }}</td>
                                    <td>
                                        @php
                                            $badgeColor = match ($order->status) {
                                                'pending' => 'bg-secondary',
                                                'processing' => 'bg-info',
                                                'dispatched' => 'bg-warning',
                                                'delivered' => 'bg-success',
                                                default => 'bg-secondary',
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeColor }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order->id) }}"
                                            class="btn btn-sm btn-primary">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-3">
                                        This customer hasn't placed any orders yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection
