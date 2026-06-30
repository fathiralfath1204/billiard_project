<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate   = $request->input('end_date', now()->endOfMonth()->format('Y-m-d'));

        $transactions = Transaction::with('booking.tableBilliard')
            ->where('status', 'paid')
            ->whereBetween('paid_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->get();

        $totalPendapatan = $transactions->sum('total_amount');
        $totalTransaksi  = $transactions->count();

        $pendapatanHarian = Transaction::where('status', 'paid')
            ->whereBetween('paid_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->select(DB::raw('DATE(paid_at) as tanggal'), DB::raw('SUM(total_amount) as total'))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $mejaTerpopuler = Booking::select('table_billiard_id', DB::raw('count(*) as total_booking'))
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->groupBy('table_billiard_id')
            ->orderByDesc('total_booking')
            ->with('tableBilliard')
            ->take(5)
            ->get();

        return view('reports.index', compact(
            'transactions', 'totalPendapatan', 'totalTransaksi',
            'pendapatanHarian', 'mejaTerpopuler', 'startDate', 'endDate'
        ));
    }
}