<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Order</title>
</head>
<body>
    <h1>Manajemen Order</h1>

    <a href="{{ route('admin.dashboard') }}">← Dashboard</a> |
    <a href="{{ route('admin.orders.create') }}">+ Tambah Order</a>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>No</th>
                <th>Customer</th>
                <th>Items</th>
                <th>Layanan</th>
                <th>Berat</th>
                <th>Total</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $i => $order)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->items }}</td>
                <td>{{ $order->service }}</td>
                <td>{{ $order->weight ?? '-' }} kg</td>
                <td>Rp {{ number_format($order->total ?? 0, 0, ',', '.') }}</td>
                <td>{{ $order->getStatusLabel() }}</td>
                <td>
                    {{-- Update Status --}}
                    <form method="POST" action="{{ route('admin.orders.update-status', $order) }}" style="display:inline">
                        @csrf
                        @method('PATCH')
                        <select name="status" onchange="this.form.submit()">
                            <option value="pending"    {{ $order->status === 'pending'    ? 'selected' : '' }}>Menunggu Pickup</option>
                            <option value="in_process" {{ $order->status === 'in_process' ? 'selected' : '' }}>Sedang Diproses</option>
                            <option value="ready"      {{ $order->status === 'ready'      ? 'selected' : '' }}>Siap Diambil</option>
                            <option value="completed"  {{ $order->status === 'completed'  ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </form>

                    <a href="{{ route('admin.orders.edit', $order) }}">Konfirmasi</a> |
                    <a href="{{ route('admin.orders.print', $order) }}" target="_blank">Print</a> |

                    <form method="POST" action="{{ route('admin.orders.destroy', $order) }}" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus order ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8">Belum ada order.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
