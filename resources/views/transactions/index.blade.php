<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Transaksi
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded-lg">

                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-xl font-bold">Daftar Transaksi</h1>
                    <a href="{{ route('transactions.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                        + Transaksi Baru
                    </a>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-3 rounded-lg mb-4">{{ session('success') }}</div>
                @endif

                <table class="w-full border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left">Invoice</th>
                            <th class="p-3 text-left">Meja</th>
                            <th class="p-3 text-left">Total</th>
                            <th class="p-3 text-left">Metode</th>
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3 text-left">Tanggal</th>
                            <th class="p-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $trx)
                        <tr class="border-b">
                            <td class="p-3">{{ $trx->invoice_number }}</td>
                            <td class="p-3">{{ $trx->booking->tableBilliard->name ?? '-' }}</td>
                            <td class="p-3">Rp {{ number_format($trx->total_amount, 0, ',', '.') }}</td>
                            <td class="p-3">{{ ucfirst($trx->payment_method) }}</td>
                            <td class="p-3">
                                <span class="px-2 py-1 rounded-full text-xs
                                    @if($trx->status == 'paid') bg-green-100 text-green-700
                                    @elseif($trx->status == 'pending') bg-yellow-100 text-yellow-700
                                    @else bg-red-100 text-red-700 @endif">
                                    {{ ucfirst($trx->status) }}
                                </span>
                            </td>
                            <td class="p-3">{{ $trx->created_at->format('d M Y H:i') }}</td>
                            <td class="p-3">
                                <a href="{{ route('transactions.show', $trx->id) }}" class="text-blue-600">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $transactions->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>