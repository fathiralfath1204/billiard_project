<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Meja Billiard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('tables.update', $table->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor / Nama Meja</label>
                        <input type="text" name="number_table" value="{{ $table->number_table }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipe Meja</label>
                        <select name="type" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white">
                            <option value="Reguler" {{ $table->type == 'Reguler' ? 'selected' : '' }}>Reguler</option>
                            <option value="VIP" {{ $table->type == 'VIP' ? 'selected' : '' }}>VIP</option>
                            <option value="VVIP" {{ $table->type == 'VVIP' ? 'selected' : '' }}>VVIP</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga Per Jam (Rp)</label>
                        <input type="number" name="price_per_hour" value="{{ $table->price_per_hour }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status Meja</label>
                        <select name="status" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white">
                            <option value="available" {{ $table->status == 'available' ? 'selected' : '' }}>Available (Kosong)</option>
                            <option value="occupied" {{ $table->status == 'occupied' ? 'selected' : '' }}>Occupied (Digunakan)</option>
                            <option value="maintenance" {{ $table->status == 'maintenance' ? 'selected' : '' }}>Maintenance (Rusak/Perbaikan)</option>
                        </select>
                    </div>

                    <div class="flex justify-end space-x-2 mt-6">
                        <a href="{{ route('tables.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>