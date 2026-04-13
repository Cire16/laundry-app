<!DOCTYPE html>
<html>
<head>
    <title>Tambah Customer</title>
</head>
<body>
    <h1>Tambah Customer</h1>
    <a href="{{route('admin.customers.index')}}">Kembali</a>

    @if ($errors->any())
        <ul style="color: red">
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{route('admin.customers.store')}}">
        @csrf
        <p>
            <label>Nama</label><br>
            <input type="text" name="name" value="{{old('name')}}" required>
        </p>
        <p>
            <label>Email</label><br>
            <input type="email" name="email" value="{{old('email')}}" required>
        </p>
        <p>
            <label>Phone</label><br>
            <input type="text" name="phone" value="{{old('phone')}}" required>
        </p>
        <p>
           <label>Password</label><br>
           <input type="password" name="password" required>
        </p>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
