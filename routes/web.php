<?php

// Import Controller yang digunakan
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route halaman awal (landing page)
Route::get('/', fn () => view('welcome'));

// Route dahsboard (redirect berdasarkan role)
Route::get('/dashboard', function () {
    return auth()->user()->isAdmin()
        ? redirect()->route('admin.dashboard') //kalau admin -> ke dahsboar admin
        : redirect()->route('user.dashboard'); // kalau user -> ke dashboar user
        // harus login dan email terverifikasi
})->middleware(['auth', 'verified'])->name('dashboard');

//Group route untuk user yang sudah login
Route::middleware('auth')->group(function () {
    // Halaman edit profile
    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    // Update profile
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    // Hapus akun
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Group route khusus admin
// harus login dan role admin, url diawali /admin, penamaan route pakai prefix admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    // CRUD layanan (service)
    Route::resource('services', AdminServiceController::class)->except(['show']);

    // CRUD Customer
    Route::resource('customers', AdminCustomerController::class)->except(['edit', 'update']);

    Route::resource('orders', AdminOrderController::class)->except(['show']);
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::get('/orders/{order}/print', [AdminOrderController::class, 'print'])->name('orders.print');
});
// Route bawaan Laravel untuk authentication
require __DIR__ . '/auth.php';
