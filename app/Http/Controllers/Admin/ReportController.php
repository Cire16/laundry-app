<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user')->where('status', 'completed');

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $orders       = $query->latest()->get();
        $totalRevenue = $orders->sum('total');

        return view('admin.reports.index', compact('orders', 'totalRevenue'));
    }

    public function exportPdf(Request $request)
    {
        $query = Order::with('user')->where('status', 'completed');

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $orders       = $query->latest()->get();
        $totalRevenue = $orders->sum('total');

        $pdf = Pdf::loadView('admin.reports.pdf', compact('orders', 'totalRevenue'));

        return $pdf->download('laporan-laundry.pdf');
    }
}
