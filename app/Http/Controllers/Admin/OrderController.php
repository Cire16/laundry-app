<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LaundryService;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = User::where('role', 'user')->get();
        $services  = LaundryService::active()->get();
        return view('admin.orders.create', compact('customers', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'       => 'required|exists:users,id',
            'customer_name' => 'required|string',
            'phone'         => 'required|string',
            'items'         => 'required|string',
            'weight'        => 'required|numeric|min:0.1',
            'service'       => 'required|string',
            'price'         => 'required|numeric',
        ]);

        $total = $request->weight * $request->price;

        Order::create([
            'user_id'       => $request->user_id,
            'customer_name' => $request->customer_name,
            'phone'         => $request->phone,
            'items'         => $request->items,
            'weight'        => $request->weight,
            'service'       => $request->service,
            'price'         => $request->price,
            'total'         => $total,
            'status'        => 'in_process',
        ]);

        return redirect()->route('admin.orders.index')->with('success', 'Order berhasil dibuat.');
    }

    public function edit(Order $order)
    {
        $customers = User::where('role', 'user')->get();
        $services  = LaundryService::active()->get();
        return view('admin.orders.confirm', compact('order', 'customers', 'services'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'customer_name'    => 'required|string',
            'phone'            => 'required|string',
            'items'            => 'required|string',
            'weight'           => 'required|numeric|min:0.1',
            'service'          => 'required|string',
            'price'            => 'required|numeric',
            'estimated_pickup' => 'nullable|date',
        ]);

        $total = $request->weight * $request->price;

        $order->update([
            'customer_name'    => $request->customer_name,
            'phone'            => $request->phone,
            'items'            => $request->items,
            'weight'           => $request->weight,
            'service'          => $request->service,
            'price'            => $request->price,
            'total'            => $total,
            'estimated_pickup' => $request->estimated_pickup,
            'is_confirmed'     => true,
            'confirmed_at'     => now(),
            'status'           => 'in_process',
        ]);

        return redirect()->route('admin.orders.index')->with('success', 'Order berhasil dikonfirmasi.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Order berhasil dihapus.');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,in_process,ready,completed',
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status berhasil diupdate.');
    }

    public function print(Order $order)
    {
        return view('admin.orders.print', compact('order'));
    }
}
