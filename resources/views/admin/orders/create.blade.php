<!DOCTYPE html>
<html>
<head>
    <title>Tambah Order</title>
</head>
<body>
    <h1>Tambah Order</h1>
    <a href="{{ route('admin.orders.index') }}">← Kembali</a>

    @if($errors->any())
        <ul style="color:red">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('admin.orders.store') }}">
        @csrf
        <p>
            <label>Customer</label><br>
            <select name="user_id" id="user_id" onchange="fillCustomer(this)" required>
                <option value="">-- Pilih Customer --</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}"
                        data-name="{{ $customer->name }}"
                        data-phone="{{ $customer->phone }}"
                        {{ old('user_id') == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </p>
        <p>
            <label>Nama Customer</label><br>
            <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" required>
        </p>
        <p>
            <label>Phone</label><br>
            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required>
        </p>
        <p>
            <label>Items (jenis cucian)</label><br>
            <textarea name="items" required>{{ old('items') }}</textarea>
        </p>
        <p>
            <label>Berat (kg)</label><br>
            <input type="number" step="0.01" name="weight" id="weight" value="{{ old('weight') }}" min="0.1" required onchange="calcTotal()">
        </p>
        <p>
            <label>Layanan</label><br>
            <select name="service" id="service" onchange="calcTotal()" required>
                <option value="">-- Pilih Layanan --</option>
                @foreach($services as $service)
                    <option value="{{ $service->name }}"
                        data-price="{{ $service->price_per_kg }}"
                        {{ old('service') === $service->name ? 'selected' : '' }}>
                        {{ $service->name }} - {{ $service->formatted_price }}/kg
                    </option>
                @endforeach
            </select>
        </p>
        <input type="hidden" name="price" id="price" value="{{ old('price') }}">
        <p>
            <label>Total Harga</label><br>
            <span id="total_display">Rp 0</span>
        </p>
        <button type="submit">Simpan</button>
    </form>

    <script>
        function fillCustomer(select) {
            const opt = select.options[select.selectedIndex];
            document.getElementById('customer_name').value = opt.dataset.name || '';
            document.getElementById('phone').value = opt.dataset.phone || '';
        }

        function calcTotal() {
            const weight  = parseFloat(document.getElementById('weight').value) || 0;
            const service = document.getElementById('service');
            const opt     = service.options[service.selectedIndex];
            const price   = parseFloat(opt.dataset.price) || 0;
            const total   = weight * price;

            document.getElementById('price').value    = price;
            document.getElementById('total_display').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }
    </script>
</body>
</html>
