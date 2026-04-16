<!DOCTYPE html>
<html>
<head>
    <title>Daftar Invoice</title>
</head>
<body>
    <h1>Daftar Invoice</h1>

    <a href="{{ route('admin.dashboard') }}">← Dashboard</a>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>No</th>
                <th>Invoice #</th>
                <th>Customer</th>
                <th>Layanan</th>
                <th>Berat</th>
                <th>Total</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($invoices as $i => $invoice)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>#{{ $invoice->id }}</td>
                <td>{{ $invoice->customer_name }}</td>
                <td>{{ $invoice->service }}</td>
                <td>{{ $invoice->weight }} kg</td>
                <td>Rp {{ number_format($invoice->total, 0, ',', '.') }}</td>
                <td>{{ $invoice->getStatusLabel() }}</td>
                <td>{{ $invoice->created_at->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ route('admin.invoices.show', $invoice) }}">Detail</a> |
                    <a href="{{ route('admin.invoices.print', $invoice) }}" target="_blank">Print</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9">Belum ada invoice.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
