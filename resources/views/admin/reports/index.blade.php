<!DOCTYPE html>
<html>
<head>
    <title>Laporan</title>
</head>
<body>
    <h1>Laporan Pendapatan</h1>

    <a href="{{ route('admin.dashboard') }}">← Dashboard</a>

    {{-- Filter --}}
    <form method="GET" action="{{ route('admin.reports.index') }}" style="margin: 16px 0">
        <label>Dari:</label>
        <input type="date" name="start_date" value="{{ request('start_date') }}">

        <label>Sampai:</label>
        <input type="date" name="end_date" value="{{ request('end_date') }}">

        <button type="submit">Filter</button>
        <a href="{{ route('admin.reports.index') }}">Reset</a>

        <a href="{{ route('admin.reports.export') }}?{{ http_build_query(request()->query()) }}">
            Export PDF
        </a>
    </form>

    <p><strong>Total Pendapatan: Rp {{ number_format($totalRevenue, 0, ',', '.') }}</strong></p>
    <p>Total Order Selesai: {{ $orders->count() }}</p>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>No</th>
                <th>Invoice #</th>
                <th>Customer</th>
                <th>Layanan</th>
                <th>Berat</th>
                <th>Total</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $i => $order)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>#{{ $order->id }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->service }}</td>
                <td>{{ $order->weight }} kg</td>
                <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                <td>{{ $order->created_at->format('d/m/Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7">Belum ada data.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
