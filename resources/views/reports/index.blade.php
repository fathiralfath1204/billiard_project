<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Laporan Pendapatan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white p-6 shadow rounded-lg">
                <form method="GET" class="flex gap-3">
                    <input type="date" name="start_date" value="{{ $startDate }}" class="border rounded-lg px-3 py-2">
                    <input type="date" name="end_date" value="{{ $endDate }}" class="border rounded-lg px-3 py-2">
                    <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded-lg">Filter</button>
                </form>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white p-5 rounded-lg shadow">
                    <p class="text-gray-500">Total Pendapatan</p>
                    <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                </div>
                <div class="bg-white p-5 rounded-lg shadow">
                    <p class="text-gray-500">Total Transaksi Lunas</p>
                    <p class="text-2xl font-bold text-blue-600">{{ $totalTransaksi }}</p>
                </div>
            </div>

            <div class="bg-white p-5 rounded-lg shadow">
                <h2 class="font-semibold mb-3">Pendapatan Harian</h2>
                <table class="w-full">
                    <thead>
                        <tr class="text-left border-b">
                            <th class="p-2">Tanggal</th>
                            <th class="p-2">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendapatanHarian as $item)
                        <tr class="border-b">
                            <td class="p-2">{{ $item->tanggal }}</td>
                            <td class="p-2">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="bg-white p-5 rounded-lg shadow">
                <h2 class="font-semibold mb-3">Meja Terpopuler</h2>
                <table class="w-full">
                    <thead>
                        <tr class="text-left border-b">
                            <th class="p-2">Meja</th>
                            <th class="p-2">Jumlah Booking</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mejaTerpopuler as $item)
                        <tr class="border-b">
                            <td class="p-2">{{ $item->tableBilliard->name ?? '-' }}</td>
                            <td class="p-2">{{ $item->total_booking }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="bg-white p-5 rounded-lg shadow">
                <h2 class="font-semibold mb-3">Detail Transaksi</h2>
                <table class="w-full">
                    <thead>
                        <tr class="text-left border-b">
                            <th class="p-2">Invoice</th>
                            <th class="p-2">Meja</th>
                            <th class="p-2">Total</th>
                            <th class="p-2">Tanggal Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $trx)
                        <tr class="border-b">
                            <td class="p-2">{{ $trx->invoice_number }}</td>
                            <td class="p-2">{{ $trx->booking->tableBilliard->name ?? '-' }}</td>
                            <td class="p-2">Rp {{ number_format($trx->total_amount, 0, ',', '.') }}</td>
                            <td class="p-2">{{ $trx->paid_at?->format('d M Y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>