<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Transaksi
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded-lg">

                <form method="POST" action="{{ route('transactions.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Pilih Booking</label>
                        <select name="booking_id" class="w-full border rounded-lg px-3 py-2" required>
                            <option value="">-- Pilih Booking --</option>
                            @foreach($bookings as $booking)
                                <option value="{{ $booking->id }}">
                                    {{ $booking->tableBilliard->name ?? 'Meja' }} - {{ $booking->customer_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Total Bayar (Rp)</label>
                        <input type="number" name="total_amount" class="w-full border rounded-lg px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Metode Pembayaran</label>
                        <select name="payment_method" class="w-full border rounded-lg px-3 py-2" required>
                            <option value="cash">Cash</option>
                            <option value="transfer">Transfer</option>
                            <option value="qris">QRIS</option>
                            <option value="debit">Debit</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Status</label>
                        <select name="status" class="w-full border rounded-lg px-3 py-2" required>
                            <option value="pending">Pending</option>
                            <option value="paid">Paid (Lunas)</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg">Simpan Transaksi</button>
                    <a href="{{ route('transactions.index') }}" class="ml-3 text-gray-600">Batal</a>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>