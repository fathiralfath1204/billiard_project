<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Menu
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded-lg">

                <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Nama Menu</label>
                        <input type="text" name="name" value="{{ $product->name }}" class="w-full border rounded-lg px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Kategori</label>
                        <select name="category" class="w-full border rounded-lg px-3 py-2" required>
                            <option value="makanan" {{ $product->category == 'makanan' ? 'selected' : '' }}>Makanan</option>
                            <option value="minuman" {{ $product->category == 'minuman' ? 'selected' : '' }}>Minuman</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Harga (Rp)</label>
                        <input type="number" name="price" value="{{ $product->price }}" class="w-full border rounded-lg px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Stok</label>
                        <input type="number" name="stock" value="{{ $product->stock }}" class="w-full border rounded-lg px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Status</label>
                        <select name="status" class="w-full border rounded-lg px-3 py-2" required>
                            <option value="aktif" {{ $product->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ $product->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>

                    @if($product->image)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-20 h-20 object-cover rounded-lg">
                    </div>
                    @endif

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Ganti Gambar (opsional)</label>
                        <input type="file" name="image" class="w-full border rounded-lg px-3 py-2">
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg">Update Menu</button>
                    <a href="{{ route('products.index') }}" class="ml-3 text-gray-600">Batal</a>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>