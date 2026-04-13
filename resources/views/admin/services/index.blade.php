<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Layanan</title>
</head>
<body>
    <h1>Manajemen Layanan</h1>

    <a href="{{route('admin.dashboard')}}">Dashboard</a> |
    <a href="{{route('admin.services.create')}}">Tambah Layanan</a>

    @if (session('success'))
        <p style="color: green">{{session('success')}}</p>
    @endif

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Layanan</th>
                <th>Harga/kg</th>
                <th>Deskripsi</th>
                <th>Status</th>
                <th>Urutan</th>
                <th>Aksi/th>
            </tr>
        </thead>
        <tbody>
            @forelse ($services as $i => $service )
            <tr>
                <td>{{$i + 1}}</td>
                <td>{{$service->name}}</td>
                <td>{{$service->formatted_price}}</td>
                <td>{{$service->description ?? '-'}}</td>
                <td>{{$service->is_active ? 'Aktif' : 'Nonaktif'}}</td>
                <td>{{$service->sort_order}}</td>
                <td>
                    <a href="{{route('admin.services.edit', $service)}}">Edit</a>
                    <form method="POST" action="{{route('admin.services.destroy', $service)}}" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus layanan ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7">Belum ada layanan</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
