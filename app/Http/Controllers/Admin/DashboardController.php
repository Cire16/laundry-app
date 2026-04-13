<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\user;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalCustomers = User::where('role', 'user')->count();
        $totalRevenue = Order::where('status', 'completed')->sum('total');

        return view('admin.dashboard', compact(
            'totalOrders',
            'pendingOrders',
            'totalCustomers',
            'totalRevenue'
        ));
    }
}
