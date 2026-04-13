<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'));

Route::get('/dashboard', function () {
    return auth()->user()->isAdmin()
        ? redirect()->route('admin.dashboard')
        : redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('services', AdminServiceController::class)->except(['show']);

    // Customer
    Route::resource('customers', AdminCustomerController::class)->except(['edit', 'update']);
});

require __DIR__ . '/auth.php';
