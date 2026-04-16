<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <p>Total Orders: {{$totalOrders}}</p>
    <p>Pending Orders: {{$pendingOrders}}</p>
    <p>Total Customers: {{$totalCustomers}}</p>
    <p>Total Revenue: Rp {{number_format($totalRevenue, 0, ',', '.')}}</p>

    <a href="{{route('profile.edit')}}">Profile</a>
    <a href="{{route('admin.services.index')}}">Service</a>
    <a href="{{route('admin.customers.index')}}">Customer</a>
    <a href="{{route('admin.orders.index')}}">Order</a>
    <form action="{{route('logout')}}" style="display:inline" method="POST]">\
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
