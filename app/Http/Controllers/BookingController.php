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

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dibuat!');
    }
}