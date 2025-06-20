<!DOCTYPE html>
<html>
<head>
    <title>Sales Order #{{ $order->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background: #f0f0f0; }
        h3 { margin-bottom: 5px; }
    </style>
</head>
<body>
    <h3>Sales Order #{{ $order->id }}</h3>

    <p><strong>Customer:</strong> {{ $order->customer_name }}</p>
    <p><strong>Date:</strong> {{ $order->created_at->format('d M Y h:i A') }}</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Price (₹)</th>
                <th>Qty</th>
                <th>Total (₹)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->product->name ?? 'N/A' }}</td>
                    <td>{{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align: right;"><strong>Total:</strong></td>
                <td><strong>₹{{ number_format($order->total_amount, 2) }}</strong></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
