<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LaundryService;
use App\Http\Requests\ServiceRequest; // form request untuk validasi

class ServiceController extends Controller
{
    // menampilkan semua layanan
    public function index()
    {
        // ambil semua layanan dan urutkan
        $services = LaundryService::orderBy('sort_order')->get();
        // Kirim ke view
        return view('admin.services.index', compact('services'));
    }

    // menampilkan form tambah layanan
    public function create()
    {
        return view('admin.services.create');
    }

    // menyimpan layanan baru
    public function store(ServiceRequest $request)
    {
        // validated() = ambil data yang sudah lolos validasi
        LaundryService::create($request->validated());
        return redirect()->route('admin.services.index')->with('success', 'Layanan Berhasil ditambahkan');
    }

    // menampilkan form edit
    public function edit(LaundryService $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    // update data layanan
    public function update(ServiceRequest $request, LaundryService $service)
    {
        // update data berdasarkan input yang valid
        $service->update($request->validated());
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil diupdate');
    }

    // menghapus layanan
    public function destroy(LaundryService $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil dihapus');
    }
}
