<!DOCTYPE html>
<html>
<head>
    <title>Detail Customer</title>
</head>
<body>
    <h1>Detail Customer</h1>
    <a href="{{route('admin.customers.index')}}">Kemabali</a>

    <h2>Info Customer</h2>
    <p><strong>Nama:</strong> {{$customer->name}}</p>
    <p><strong>Email:</strong> {{$customer->email}}</p>
    <p><strong>Phone:</strong> {{$customer->phone}}</p>

    <h2>Riwayat Order</h2>
    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>No</th>
                <th>Items</th>
                <th>layanan</th>
                <th>Berat</th>
                <th>Total</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $i => $order)
            <tr>
                <td>{{$i + 1}}</td>
                <td>{{$order->items}}</td>
                <td>{{$order->service}}</td>
                <td>{{$order->service}}</td>
                <td>{{$order->weight ?? '-'}} kg</td>
                <td>Rp {{number_format($order->total ?? 0, 0, ',', '.')}}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7">Belum ada order.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
