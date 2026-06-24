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

    // FUNGSI BARU UNTUK ARSIP/DETAIL
    public function show($id)
    {
        $booking = Booking::with('tableBilliard')->findOrFail($id);
        return view('bookings.show', compact('booking'));
    }

    public function create(Request $request)
    {
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

        Booking::create([
            'table_billiard_id' => $validated['table_billiard_id'],
            'customer_name' => $validated['customer_name'],
            'start_time' => now(),
            'status' => 'active',
        ]);

        $table = TableBilliard::find($validated['table_billiard_id']);
        $table->update(['status' => 'occupied']);

        return redirect()->route('bookings.index')->with('success', 'Meja berhasil mulai disewa!');
    }

    public function checkout($id)
    {
        $booking = Booking::with('tableBilliard')->findOrFail($id);
        
        $booking->end_time = now();
        
        $startTime = Carbon::parse($booking->start_time);
        $endTime = Carbon::parse($booking->end_time);
        
        $durationInHours = max($startTime->diffInMinutes($endTime) / 60, 0.1);
        
        $pricePerHour = $booking->tableBilliard->price_per_hour ?? 0;
        $booking->total_price = round($durationInHours * $pricePerHour);
        $booking->status = 'completed';
        $booking->save();

        if ($booking->tableBilliard) {
            $booking->tableBilliard->update(['status' => 'available']);
        }

        return redirect()->route('bookings.index')->with('success', 'Transaksi selesai! Kasir silakan tagih pembayaran.');
    }
}