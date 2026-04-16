<!DOCTYPE html>
<html>
<head>
    <title>Print Order #{{ $order->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; }
        td, th { border: 1px solid #000; padding: 8px; }
        .text-right { text-align: right; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>
    <div class="no-print">
        <button onclick="window.print()">Print</button>
        <a href="{{ route('admin.orders.index') }}">← Kembali</a>
        <hr>
    </div>

    <h2 style="text-align:center">NOTA LAUNDRY</h2>
    <p><strong>No Order:</strong> #{{ $order->id }}</p>
    <p><strong>Tanggal:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
    <p><strong>Customer:</strong> {{ $order->customer_name }}</p>
    <p><strong>Phone:</strong> {{ $order->phone }}</p>

    <table>
        <tr>
            <th>Items</th>
            <th>Layanan</th>
            <th>Berat</th>
            <th>Harga/kg</th>
            <th>Total</th>
        </tr>
        <tr>
            <td>{{ $order->items }}</td>
            <td>{{ $order->service }}</td>
            <td>{{ $order->weight }} kg</td>
            <td>Rp {{ number_format($order->price, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
        </tr>
    </table>

    @if($order->estimated_pickup)
    <p><strong>Estimasi Pickup:</strong> {{ $order->estimated_pickup->format('d/m/Y H:i') }}</p>
    @endif

    <p><strong>Status:</strong> {{ $order->getStatusLabel() }}</p>
</body>
</html>
