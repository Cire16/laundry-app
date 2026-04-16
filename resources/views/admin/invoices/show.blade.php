<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $invoice->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        td, th { border: 1px solid #000; padding: 8px; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>
    <div class="no-print">
        <button onclick="window.print()">🖨️ Print</button>
        <a href="{{ route('admin.invoices.index') }}">← Kembali</a>
        <hr>
    </div>

    <h2 class="text-center">INVOICE LAUNDRY</h2>
    <p><strong>Invoice #:</strong> {{ $invoice->id }}</p>
    <p><strong>Tanggal:</strong> {{ $invoice->created_at->format('d/m/Y H:i') }}</p>
    <p><strong>Customer:</strong> {{ $invoice->customer_name }}</p>
    <p><strong>Phone:</strong> {{ $invoice->phone }}</p>
    @if($invoice->address)
    <p><strong>Alamat:</strong> {{ $invoice->address }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Items</th>
                <th>Layanan</th>
                <th>Berat</th>
                <th>Harga/kg</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $invoice->items }}</td>
                <td>{{ $invoice->service }}</td>
                <td>{{ $invoice->weight }} kg</td>
                <td>Rp {{ number_format($invoice->price, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($invoice->total, 0, ',', '.') }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-right"><strong>Total Bayar</strong></td>
                <td><strong>Rp {{ number_format($invoice->total, 0, ',', '.') }}</strong></td>
            </tr>
        </tfoot>
    </table>

    @if($invoice->estimated_pickup)
    <p><strong>Estimasi Pickup:</strong> {{ $invoice->estimated_pickup->format('d/m/Y H:i') }}</p>
    @endif

    <p><strong>Status:</strong> {{ $invoice->getStatusLabel() }}</p>

    <br>
    <p class="text-center">Terima kasih telah menggunakan layanan kami!</p>
</body>
</html>
