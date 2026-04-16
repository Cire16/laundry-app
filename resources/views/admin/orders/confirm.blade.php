<!DOCTYPE html>
<html>
<head>
    <title>Konfirmasi Order</title>
</head>
<body>
    <h1>Konfirmasi Order #{{ $order->id }}</h1>
    <a href="{{ route('admin.orders.index') }}">← Kembali</a>

    @if($errors->any())
        <ul style="color:red">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('admin.orders.update', $order) }}">
        @csrf
        @method('PUT')
        <p>
            <label>Nama Customer</label><br>
            <input type="text" name="customer_name" value="{{ old('customer_name', $order->customer_name) }}" required>
        </p>
        <p>
            <label>Phone</label><br>
            <input type="text" name="phone" value="{{ old('phone', $order->phone) }}" required>
        </p>
        <p>
            <label>Items</label><br>
            <textarea name="items" required>{{ old('items', $order->items) }}</textarea>
        </p>
        <p>
            <label>Berat (kg)</label><br>
            <input type="number" step="0.01" name="weight" id="weight"
                value="{{ old('weight', $order->weight) }}" min="0.1" required onchange="calcTotal()">
        </p>
        <p>
            <label>Layanan</label><br>
            <select name="service" id="service" onchange="calcTotal()" required>
                @foreach($services as $service)
                    <option value="{{ $service->name }}"
                        data-price="{{ $service->price_per_kg }}"
                        {{ old('service', $order->service) === $service->name ? 'selected' : '' }}>
                        {{ $service->name }} - {{ $service->formatted_price }}/kg
                    </option>
                @endforeach
            </select>
        </p>
        <input type="hidden" name="price" id="price" value="{{ old('price', $order->price) }}">
        <p>
            <label>Total Harga</label><br>
            <span id="total_display">Rp {{ number_format($order->total ?? 0, 0, ',', '.') }}</span>
        </p>
        <p>
            <label>Estimasi Pickup</label><br>
            <input type="datetime-local" name="estimated_pickup"
                value="{{ old('estimated_pickup', $order->estimated_pickup?->format('Y-m-d\TH:i')) }}">
        </p>
        <button type="submit">Konfirmasi Order</button>
    </form>

    <script>
        function calcTotal() {
            const weight  = parseFloat(document.getElementById('weight').value) || 0;
            const service = document.getElementById('service');
            const opt     = service.options[service.selectedIndex];
            const price   = parseFloat(opt.dataset.price) || 0;
            const total   = weight * price;

            document.getElementById('price').value = price;
            document.getElementById('total_display').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }
    </script>
</body>
</html>
