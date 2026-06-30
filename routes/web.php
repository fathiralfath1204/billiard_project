<?php

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExternalApiController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\TableBilliardController;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [ExternalApiController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('tables', TableBilliardController::class);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::patch('/bookings/{id}/checkout', [BookingController::class, 'checkout'])->name('bookings.checkout');
    Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
    Route::resource('tables', TableController::class);
});

// ================= TRANSAKSI & LAPORAN =================
Route::middleware(['auth', 'admin'])->group(function () {

    // Transaksi
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');
    Route::patch('/transactions/{transaction}/status', [TransactionController::class, 'updateStatus'])->name('transactions.updateStatus');

    // Laporan
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

});

// ================= MENU MAKANAN & MINUMAN =================
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('products', ProductController::class);
});

// ================= LOGIN ADMIN =================
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');