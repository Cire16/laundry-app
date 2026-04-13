<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Customer</title>
</head>
<body>
    <h1>Manajemen Customer</h1>

    <a href="{{route('admin.dashboard')}}">Dashboard</a> |
    <a href="{{route('admin.customers.create')}}">Tambah Customer</a>

    @if (session('success'))
        <p style="color:green">{{session('success')}}</p>
    @endif

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Total Order</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($customers as $i => $customer)
                <tr>
                    <td>{{$i +1}}</td>
                    <td>{{$customer->name}}</td>
                    <td>{{$customer->email}}</td>
                    <td>{{$customer->phone}}</td>
                    <td>{{$customer->orders->count()}}</td>
                    <td>
                        <a href="{{route('admin.customers.show', $customer)}}">Detail</a>
                        <form method="POST" action="{{route('admin.customers.destroy', $customer)}}" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus customer ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada customer.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
