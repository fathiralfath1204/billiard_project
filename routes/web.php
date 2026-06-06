<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExternalApiController;
use App\Http\Controllers\TableController;

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

use App\Http\Controllers\TableBilliardController;

Route::middleware(['auth'])->group(function () {
    Route::resource('tables', TableBilliardController::class);
});

use App\Http\Controllers\BookingController;

Route::middleware(['auth'])->group(function () {
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
});
Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
Route::patch('/bookings/{id}/checkout', [BookingController::class, 'checkout'])->name('bookings.checkout');
Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
Route::resource('tables', TableController::class);