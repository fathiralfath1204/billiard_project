<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Transaksi
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded-lg">

                <p><strong>Invoice:</strong> {{ $transaction->invoice_number }}</p>
                <p><strong>Meja:</strong> {{ $transaction->booking->tableBilliard->name ?? '-' }}</p>
                <p><strong>Customer:</strong> {{ $transaction->booking->customer_name ?? '-' }}</p>
                <p><strong>Total:</strong> Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</p>
                <p><strong>Metode:</strong> {{ ucfirst($transaction->payment_method) }}</p>
                <p><strong>Status:</strong> {{ ucfirst($transaction->status) }}</p>
                <p><strong>Dibuat:</strong> {{ $transaction->created_at->format('d M Y H:i') }}</p>

                @if($transaction->status != 'paid')
                <form method="POST" action="{{ route('transactions.updateStatus', $transaction->id) }}" class="mt-4">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="paid">
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">Tandai Lunas</button>
                </form>
                @endif

                <a href="{{ route('transactions.index') }}" class="inline-block mt-4 text-gray-600">← Kembali</a>

            </div>
        </div>
    </div>
</x-app-layout>