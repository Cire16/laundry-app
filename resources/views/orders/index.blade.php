<h1>Daftar Order</h1>

@foreach ($orders as $order)
    <p>
        {{ $order->customer_name }} -
        {{ $order->getStatusLabel() }}
    </p>
@endforeach
