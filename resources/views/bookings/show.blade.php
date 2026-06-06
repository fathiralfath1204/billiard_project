<x-app-layout>
    <div class="py-10 max-w-4xl mx-auto px-6">
        <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-sm border border-slate-100 dark:border-gray-700">
            <h1 class="text-2xl font-black text-slate-800 dark:text-gray-100 mb-6">Detail Transaksi #BKG-{{ $booking->id }}</h1>
            
            <div class="space-y-4 text-slate-600 dark:text-gray-300">
                <p><strong>Nama Pelanggan:</strong> {{ $booking->customer_name }}</p>
                <p><strong>Meja:</strong> {{ $booking->tableBilliard->number_table ?? 'N/A' }}</p>
                <p><strong>Waktu Mulai:</strong> {{ $booking->start_time }}</p>
                <p><strong>Waktu Selesai:</strong> {{ $booking->end_time }}</p>
                <p class="text-lg font-bold text-emerald-600"><strong>Total Bayar:</strong> Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
            </div>

            <div class="mt-8">
                <a href="{{ route('bookings.index') }}" class="px-6 py-2 bg-slate-800 text-white rounded-lg font-bold hover:bg-slate-700">
                    Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
</x-app-layout>