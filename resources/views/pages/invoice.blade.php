<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->order_number }} — SmartPickz</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            color: #333;
            padding: 40px;
            background: white;
        }

  
        .print-btn {
            text-align: right;
            margin-bottom: 24px;
        }

        .print-btn button {
            background: #00378F;
            color: white;
            border: none;
            padding: 10px 24px;
            font-size: 13px;
            cursor: pointer;
            border-radius: 4px;
        }

        .print-btn button:hover {
            background: #002a6e;
        }

  
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid #000;
        }

        .brand-name {
            font-size: 28px;
            font-weight: bold;
            color: #00378F;
        }

        .brand-sub {
            font-size: 12px;
            color: #666;
            margin-top: 4px;
        }

        .brand-contact {
            margin-top: 8px;
            font-size: 12px;
            color: #555;
            line-height: 1.6;
        }

        .invoice-title {
            text-align: right;
        }

        .invoice-title h2 {
            font-size: 24px;
            font-weight: bold;
            color: #000;
            letter-spacing: 2px;
        }

        .invoice-title p {
            font-size: 12px;
            color: #555;
            margin-top: 6px;
            line-height: 1.8;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 6px;
        }

        .status-pending {
            background: #6C757D;
            color: white;
        }

        .status-processing {
            background: #17A2B8;
            color: white;
        }

        .status-dispatched {
            background: #FFC107;
            color: #333;
        }

        .status-delivered {
            background: #28A745;
            color: white;
        }


        .invoice-cust {
            display: flex;
            justify-content: space-between;
            margin-bottom: 36px;
        }

        .cust-block h4 {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #888;
            margin-bottom: 8px;
        }

        .cust-block p {
            font-size: 13px;
            line-height: 1.7;
            color: #333;
        }

 
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
        }

        thead tr {
            background: #00378F;
            color: white;
        }

        thead th {
            padding: 10px 14px;
            text-align: left;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        thead th:last-child {
            text-align: right;
        }

        tbody tr {
            border-bottom: 1px solid #eee;
        }

        tbody tr:nth-child(even) {
            background: #fafafa;
        }

        tbody td {
            padding: 12px 14px;
            font-size: 13px;
        }

        tbody td:last-child {
            text-align: right;
        }

  
        .totals-wrap {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 40px;
        }

        .totals-table {
            width: 280px;
            border-collapse: collapse;
        }

        .totals-table td {
            padding: 7px 14px;
            font-size: 13px;
        }

        .totals-table td:last-child {
            text-align: right;
        }

        .totals-table .grand-total td {
            font-weight: bold;
            font-size: 15px;
            border-top: 2px solid #000;
            padding-top: 10px;
        }

  
        .invoice-footer {
            border-top: 1px solid #ddd;
            padding-top: 20px;
            text-align: center;
            color: #888;
            font-size: 11px;
            line-height: 1.8;
            padding-bottom: auto
        }

        /* ── Print styles ── */
        @media print {
            .print-btn {
                display: none;
            }

            body {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    {{-- Print btn --}}
    <div class="print-btn">
        <button onclick="window.print()">
            🖨 Print / Save as PDF
        </button>
    </div>

    {{-- Header --}}
    <div class="invoice-header">
        <div>
            <div class="brand-name">SmartPickz</div>
            <div class="brand-sub">Electronics &amp; Gadgets</div>
            <div class="brand-contact">
                Colombo, Sri Lanka<br>
                info@smartpickz.com
            </div>
        </div>
        <div class="invoice-title">
            <h2>INVOICE</h2>
            <p>
                Invoice No: <strong>#{{ $order->order_number }}</strong><br>
                Date: {{ $order->created_at->format('M d, Y') }}<br>
                Payment: Cash on Delivery
            </p>
            <span class="status-badge status-{{ $order->status }}">
                {{ ucfirst($order->status) }}
            </span>
        </div>
    </div>

    {{-- order detals --}}
    <div class="invoice-cust">
        <div class="cust-block">
            <h4>Bill To</h4>
            <p>
                <strong>{{ $order->name }}</strong><br>
                {{ $order->street_address }}<br>
                {{ $order->city }}, {{ $order->zip_code }}<br>
                {{ $order->phone }}<br>
                {{ $order->email }}
            </p>
        </div>
        <div class="cust-block" style="text-align:right;">
            <h4>Order Details</h4>
            <p>
                Order: <strong>#{{ $order->order_number }}</strong><br>
                Placed: {{ $order->created_at->format('M d, Y h:i A') }}<br>
                Items: {{ $order->items->count() }}
            </p>
        </div>
    </div>

    {{-- products --}}
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>SKU</th>
                <th>Unit Price</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->sku ?? '—' }}</td>
                    <td>Rs. {{ number_format($item->price) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rs. {{ number_format($item->price * $item->quantity) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- charges --}}
    <div class="totals-wrap">
        <table class="totals-table">
            <tr>
                <td>Subtotal</td>
                <td>Rs. {{ number_format($order->subtotal) }}</td>
            </tr>
            <tr>
                <td>Shipping</td>
                <td>Rs. {{ number_format($order->shipping) }}</td>
            </tr>
            <tr class="grand-total">
                <td>Grand Total</td>
                <td>Rs. {{ number_format($order->total) }}</td>
            </tr>
        </table>
    </div>

    {{-- Footer --}}
    <div class="invoice-footer">
        <p>Thank you for shopping with SmartPickz.</p>
        <p>This is a computer-generated invoice. No signature required.</p>
        <p>Generated on: {{ now()->format('M d, Y h:i A') }}</p>
    </div>

</body>

</html>
