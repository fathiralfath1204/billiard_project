<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\TableBilliard;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

        // 2. Ubah status meja biliar menjadi 'occupied' (terpakai)
        $table = TableBilliard::find($validated['table_billiard_id']);
        $table->update(['status' => 'occupied']);

        return redirect()->route('bookings.index')->with('success', 'Meja berhasil mulai disewa!');
    }

    public function checkout($id)
    {
        $booking = Booking::with('tableBilliard')->findOrFail($id);
        
        // Catat waktu selesai bermain sekarang
        $booking->end_time = now();
        
        // Hitung selisih waktu bermain
        $startTime = Carbon::parse($booking->start_time);
        $endTime = Carbon::parse($booking->end_time);
        
        // Hitung durasi dalam satuan jam (minimal dihitung 0.1 jam atau 6 menit agar tarif tidak Rp 0 jika baru coba-coba klik)
        $durationInHours = max($startTime->diffInMinutes($endTime) / 60, 0.1);
        
        // Hitung total harga berdasarkan harga meja per jam
        $pricePerHour = $booking->tableBilliard->price_per_hour ?? 0;
        $booking->total_price = round($durationInHours * $pricePerHour);
        $booking->status = 'completed';
        $booking->save();

        // Kembalikan status meja biliar menjadi 'available' (bisa disewa kembali)
        if ($booking->tableBilliard) {
            $booking->tableBilliard->update(['status' => 'available']);
        }

        return redirect()->route('bookings.index')->with('success', 'Transaksi selesai! Kasir silakan tagih pembayaran.');
    }
}