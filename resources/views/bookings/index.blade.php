<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-800 dark:text-slate-200 leading-tight tracking-tight flex items-center">
            <span class="mr-2"></span> {{ __('Daftar Transaksi Booking Meja') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-slate-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4">
                <div>
                    <h3 class="text-xl font-black text-slate-800 dark:text-gray-100 tracking-tight">Data Penggunaan Meja</h3>
                    <p class="text-xs text-slate-400 dark:text-gray-400">Pantau durasi main, total biaya sewa, dan status operasional meja biliar secara real-time.</p>
                </div>
            </div>

            @if (session('success'))
                <div class="p-4 bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-400 rounded-xl text-sm font-semibold flex items-center shadow-sm">
                    <span class="mr-2">✅</span> {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-slate-100 dark:border-gray-700 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-slate-500 dark:text-gray-400">
                        <thead class="text-xs text-slate-700 dark:text-gray-300 uppercase bg-slate-50 dark:bg-gray-700 tracking-wider">
                            <tr>
                                <th class="px-6 py-4 font-bold text-center w-12">No</th>
                                <th class="px-6 py-4 font-bold">Nama Pelanggan</th>
                                <th class="px-6 py-4 font-bold">Meja</th>
                                <th class="px-6 py-4 font-bold">Mulai Jam</th>
                                <th class="px-6 py-4 font-bold text-center">Status</th>
                                <th class="px-6 py-4 font-bold">Total Bayar</th>
                                <th class="px-6 py-4 font-bold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-gray-700">
                            @forelse ($bookings as $index => $booking)
                                <tr class="hover:bg-slate-50/80 dark:hover:bg-gray-750 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-slate-400">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 rounded-full bg-indigo-50 dark:bg-indigo-950 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-bold text-xs uppercase">
                                                {{ substr($booking->customer_name ?? 'P', 0, 2) }}
                                            </div>
                                            <div>
                                                <div class="font-bold text-slate-800 dark:text-gray-100">{{ $booking->customer_name }}</div>
                                                <div class="text-[10px] text-slate-400">ID Booking: #BKG-{{ $booking->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2.5 py-1 text-xs font-extrabold rounded-lg bg-slate-100 dark:bg-gray-700 text-slate-700 dark:text-gray-200">
                                             {{ $booking->tableBilliard->number_table ?? 'Meja Dihapus' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-600 dark:text-gray-300 font-semibold">
                                        <span class="flex items-center text-indigo-600 dark:text-indigo-400">
                                            <span class="mr-1.5"></span> {{ $booking->start_time }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if($booking->status == 'active')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-amber-50 dark:bg-amber-950/40 text-amber-600 dark:text-amber-400 border border-amber-100 dark:border-amber-900 animate-pulse">
                                                ● Sedang Main
                                            </span>
                                        @elseif($booking->status == 'completed')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-900">
                                                ✓ Selesai
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-rose-50 dark:bg-rose-950/40 text-rose-600 dark:text-rose-400 border border-rose-100 dark:border-rose-900">
                                                ✕ Batal
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="font-extrabold text-slate-800 dark:text-gray-100">
                                            {{ $booking->total_price == 0 ? '-' : 'Rp '.number_format($booking->total_price, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-xs font-semibold">
                                        @if($booking->status == 'active')
                                            <form action="{{ route('bookings.checkout', $booking->id) }}" method="POST" onsubmit="return confirm('Selesaikan sewa meja untuk pelanggan ini?')" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="inline-flex justify-center items-center px-4 py-2 bg-rose-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-wider hover:bg-rose-700 shadow-sm transition duration-150">
                                                     Selesai / Stop
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('bookings.show', $booking->id) }}" class="inline-flex justify-center items-center px-4 py-2 bg-slate-100 hover:bg-slate-200 dark:bg-gray-700 dark:hover:bg-gray-600 rounded-xl font-bold text-xs text-slate-600 dark:text-gray-300 uppercase tracking-wider transition duration-150">
                                                 Arsip
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="p-12 text-center">
                                        <span class="text-4xl block mb-2"></span>
                                        <p class="text-slate-500 dark:text-gray-400 text-sm font-medium">Belum ada transaksi sewa meja hari ini.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>