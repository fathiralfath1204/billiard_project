<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\TableBilliard;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('tableBilliard')->latest()->get();
        return view('bookings.index', compact('bookings'));
    }
public function create(Request $request)
{
    // Mengambil ID meja dari kiriman tombol di halaman Manajemen Meja
    $tableId = $request->query('table_id');
    $table = TableBilliard::findOrFail($tableId);

    return view('bookings.create', compact('table'));
}
    public function store(Request $request)
{
    $validated = $request->validate([
        'table_billiard_id' => 'required|exists:table_billiards,id',
        'customer_name' => 'required|string|max:255',
    ]);

    // 1. Buat data transaksi booking baru
    Booking::create([
        'table_billiard_id' => $validated['table_billiard_id'],
        'customer_name' => $validated['customer_name'],
        'start_time' => now(),
        'status' => 'active',
    ]);

    // 2. Ubah status meja biliar menjadi 'terpakai' / tidak tersedia
    $table = TableBilliard::find($validated['table_billiard_id']);
    $table->update(['status' => 'occupied']); // sesuaikan dengan enum status mejamu, misal 'occupied' atau '0'

    return redirect()->route('bookings.index')->with('success', 'Meja berhasil mulai disewa!');
}
}