@extends('adminlte::page')

@section('title', 'Order #' . $order->order_number)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Order #{{ $order->order_number }}</h1>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
    </div>
@endsection

@section('content')

    <div class="row">

        {{-- Order items + summary --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Items Ordered</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>image</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                                <tr>
                                    <td>
                                        @if ($item->image)
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->product_name }}"
                                                width="50" height="50" class="rounded object-fit-cover">
                                        @else
                                            <span class="text-muted">No image</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->product_name }}</td>
                                    <td>Rs. {{ number_format($item->price) }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>Rs. {{ number_format($item->price * $item->quantity) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <span>Subtotal</span>
                        <span>Rs. {{ number_format($order->subtotal) }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Shipping</span>
                        <span>Rs. {{ number_format($order->shipping) }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold">
                        <span>Total</span>
                        <span>Rs. {{ number_format($order->total) }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Customer + Address + Status --}}
        <div class="col-md-4">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Customer</h3>
                </div>
                <div class="card-body">
                    <p><strong>{{ $order->user->name }}</strong></p>
                    <p>{{ $order->user->email }}</p>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Shipping Address</h3>
                </div>
                <div class="card-body">
                    <p>{{ $order->first_name }} {{ $order->last_name }}</p>
                    <p>{{ $order->street_address }}</p>
                    <p>{{ $order->city }}, {{ $order->zip_code }}</p>
                    <p>{{ $order->phone }}</p>
                    <p>{{ $order->email }}</p>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Order Status</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <select name="status" class="form-select mb-3">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>
                                Processing
                            </option>
                            <option value="dispatched" {{ $order->status == 'dispatched' ? 'selected' : '' }}>
                                Dispatched
                            </option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>
                                Delivered
                            </option>
                        </select>

                        <button type="submit" class="btn btn-primary w-100">
                            Update Status
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('js')
    @include('admin.partials.alerts')
@endsection
