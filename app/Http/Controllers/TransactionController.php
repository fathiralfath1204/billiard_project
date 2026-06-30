<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with('booking.tableBilliard');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59',
            ]);
        }

        $transactions = $query->latest()->paginate(15);

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $bookings = Booking::doesntHave('transaction')->get();

        return view('transactions.create', compact('bookings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_id'     => 'required|exists:bookings,id',
            'total_amount'   => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,transfer,qris,debit',
            'status'         => 'required|in:pending,paid,cancelled',
        ]);

        $validated['invoice_number'] = 'INV-' . date('Ymd') . '-' . str_pad((Transaction::max('id') + 1), 4, '0', STR_PAD_LEFT);
        $validated['cashier_id'] = auth()->id();

        if ($validated['status'] === 'paid') {
            $validated['paid_at'] = now();
        }

        Transaction::create($validated);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dicatat.');
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('booking.tableBilliard', 'cashier');
        return view('transactions.show', compact('transaction'));
    }

    public function updateStatus(Request $request, Transaction $transaction)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,cancelled',
        ]);

        $transaction->status = $request->status;
        if ($request->status === 'paid') {
            $transaction->paid_at = now();
        }
        $transaction->save();

        return back()->with('success', 'Status transaksi diperbarui.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaksi dihapus.');
    }
}