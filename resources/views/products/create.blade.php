<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Menu
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded-lg">

                <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Nama Menu</label>
                        <input type="text" name="name" class="w-full border rounded-lg px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Kategori</label>
                        <select name="category" class="w-full border rounded-lg px-3 py-2" required>
                            <option value="cemilan">cemilan</option>
                            <option value="minuman">Minuman</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Harga (Rp)</label>
                        <input type="number" name="price" class="w-full border rounded-lg px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Stok</label>
                        <input type="number" name="stock" class="w-full border rounded-lg px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Status</label>
                        <select name="status" class="w-full border rounded-lg px-3 py-2" required>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Gambar (opsional)</label>
                        <input type="file" name="image" class="w-full border rounded-lg px-3 py-2">
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg">Simpan Menu</button>
                    <a href="{{ route('products.index') }}" class="ml-3 text-gray-600">Batal</a>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>