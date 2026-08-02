<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #333;
            padding: 20px;
        }

        .header {
            background: #00378F;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .content {
            padding: 24px;
            background: #f9f9f9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }

        th {
            background: #333;
            color: white;
            padding: 10px;
            text-align: left;
            font-size: 12px;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #eee;
            font-size: 13px;
        }

        .total-row td {
            font-weight: bold;
            border-top: 2px solid #333;
        }

        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>SmartPickz</h2>
        <p>Order Confirmation</p>
    </div>

    <div class="content">
        <p>Dear {{ $order->name }},</p>

        <p>Thank you for your order! We have received your order
            and it is now being processed.</p>

        <p>
            <strong>Order Number:</strong> #{{ $order->order_number }}<br>
            <strong>Order Date:</strong> {{ $order->created_at->format('M d, Y h:i A') }}<br>
            <strong>Payment Method:</strong> Cash on Delivery<br>
            <strong>Status:</strong> {{ ucfirst($order->status) }}
        </p>

        <h3>Order Items</h3>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>SKU</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->sku ?? '—' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rs. {{ number_format($item->price) }}</td>
                        <td>Rs. {{ number_format($item->price * $item->quantity) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4">Subtotal</td>
                    <td>Rs. {{ number_format($order->subtotal) }}</td>
                </tr>
                <tr>
                    <td colspan="4">Shipping</td>
                    <td>Rs. {{ number_format($order->shipping) }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="4">Total</td>
                    <td>Rs. {{ number_format($order->total) }}</td>
                </tr>
            </tbody>
        </table>

        <h3>Delivery Address</h3>
        <p>
            {{ $order->name }}<br>
            {{ $order->street_address }}<br>
            {{ $order->city }}, {{ $order->zip_code }}<br>
            {{ $order->phone }}
        </p>

        <p>We will notify you when your order is dispatched.</p>
        <p>Thank you for shopping with SmartPickz!</p>
    </div>

    <div class="footer">
        <p>SmartPickz Electronics | Colombo, Sri Lanka</p>
        <p>This is an automated email. Please do not reply.</p>
    </div>

</body>

</html>
