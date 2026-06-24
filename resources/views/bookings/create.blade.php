<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mulai Sewa Meja') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 text-gray-700">Konfirmasi Penggunaan {{ $table->number_table }}</h3>

                <form method="POST" action="{{ route('bookings.store') }}">
                    @csrf
                    <!-- Hidden input untuk melempar ID Meja -->
                    <input type="hidden" name="table_billiard_id" value="{{ $table->id }}">

                    <!-- Input Nama Pelanggan -->
                    <div class="mb-4">
                        <label for="customer_name" class="block text-sm font-medium text-gray-700">Nama Pelanggan</label>
                        <input type="text" name="customer_name" id="customer_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('tables.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-sm">Batal</a>
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm">Mulai Main</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>