<!DOCTYPE html>
<html>
<head>
    <title>Tambah Layanan</title>
</head>
<body>
    <h1>Tambah Layanan</h1>
    <a href="{{route('admin.services.index')}}">Kembali</a>

    @if ($errors->any())
        <ul style="color: red">
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{route('admin.services.store')}}">
        @csrf
        <p>
            <label>Nama Layanan</label><br>
            <input type="text" name="name" value="{{old('name')}}" required>
        </p>
        <p>
            <label>Harga per Kg (Rp)</label><br>
            <input type="number" name="price_per_kg" value="{{old('price_per_kg')}}" min="0" required>
        </p>
        <p>
            <label>Deskripsi</label><br>
            <textarea name="description">{{old('description')}}</textarea>
        </p>
        <p>
            <label>Urutan Tampil</label><br>
            <input type="number" name="short_order" value="{{old('sort_order', 0)}}" min="0">
        </p>
        <p>
            <label>
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" {{old('is_active', true) ? 'checked' : ''}}>
            </label>
        </p>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
