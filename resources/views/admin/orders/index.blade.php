@extends('adminlte::page')

@section('title', 'Orders')

@section('content_header')
    <h1>Orders</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order Number</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>#{{ $order->order_number }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->created_at->format('M d, Y') }}</td>
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
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-3">
                                No orders yet.
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
