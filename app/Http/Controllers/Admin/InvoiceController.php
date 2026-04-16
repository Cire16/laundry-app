<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Order::with('user')
            ->whereIn('status', ['ready', 'completed'])
            ->latest()
            ->get();

        return view('admin.invoices.index', compact('invoices'));
    }

    public function show(Order $invoice)
    {
        return view('admin.invoices.show', compact('invoice'));
    }

    public function print(Order $invoice)
    {
        return view('admin.invoices.show', compact('invoice'));
    }
}
