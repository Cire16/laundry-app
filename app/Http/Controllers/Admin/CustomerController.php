<?php

namespace App\Http\Controllers\Admin;

// Import class yang dibutuhkan
use App\Http\Controllers\Controller;
use App\Models\user; //Model untuk tabel users
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    // Menampilkan semua customer
    public function index()
    {
        // Ambil semua user dengan role 'user' (customer)
        // latest() = urutkan dari terbaru
        $customers = User::where('role', 'user')->latest()->get();
        // Kirim data ke view
        return view('admin.customers.index', compact('customers'));
    }

    // Menampilkan form tambah customer
    public function create()
    {
        return view('admin.customers.create');
    }

    // Menyimpan data customer ke database
    public function store(Request $request)
    {
        // validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users', // email harus unik
            'phone' => 'required|string|max:20',
            'password' => 'required|min:6',
        ]);

        // Simpan data ke database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            // Password di-hash (dienkripsi)
            'password' => Hash::make($request->password),
            // set role sebagai user (customer)
            'role' => 'user',
            // tandai email sudah diverifikasi (AUTO)
            'email_verified_at' => now(),
        ]);
        // redirect ke halaman customer + kirim pesan sukses
        return redirect()->route('admin.customers.index')->with('success', 'Customer berhasil ditambahlan.');
    }

    // menampilkan detail customer + order miliknya
    public function show(User $customer)
    {
        // Ambil semua order milik customer
        // orders() = relasi dari model user
        $orders = $customer->orders()->latest()->get();
        // kirim ke view
        return view('admin.customers.show', compact('customer', 'orders'));
    }

    // Menghapus customer
    public function destroy(User $customer)
    {
        //  Hapus data dari database
        $customer->delete();
        // redirect kembali + pesam success
        return redirect()->route('admin.customers.index')->with('success', 'Customer berhasil dihapus.');
    }
}
