<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>

    <nav>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a> |
        <a href="{{ route('admin.orders.index') }}">Orders</a> |
        <a href="{{ route('admin.customers.index') }}">Customers</a> |
        <a href="{{ route('admin.services.index') }}">Services</a> |
        <a href="{{ route('admin.invoices.index') }}">Invoices</a> |
        <a href="{{ route('admin.reports.index') }}">Reports</a> |
        <form method="POST" action="{{ route('logout') }}" style="display:inline">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </nav>

    <hr>

    <h2>Ringkasan</h2>
    <table border="1" cellpadding="12">
        <tr>
            <td>
                <strong>Total Order</strong><br>
                <big>{{ $totalOrders }}</big>
            </td>
            <td>
                <strong>Menunggu Pickup</strong><br>
                <big>{{ $pendingOrders }}</big>
            </td>
            <td>
                <strong>Total Customer</strong><br>
                <big>{{ $totalCustomers }}</big>
            </td>
            <td>
                <strong>Total Pendapatan</strong><br>
                <big>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</big>
            </td>
        </tr>
    </table>

    <hr>

    <h2>Order Terbaru</h2>
    @php
        $latestOrders = \App\Models\Order::with('user')->latest()->take(5)->get();
    @endphp

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Layanan</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($latestOrders as $order)
            <tr>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->service }}</td>
                <td>{{ $order->getStatusLabel() }}</td>
                <td>{{ $order->created_at->format('d/m/Y') }}</td>
                <td><a href="{{ route('admin.orders.edit', $order) }}">Detail</a></td>
            </tr>
            @empty
            <tr>
                <td colspan="5">Belum ada order.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
