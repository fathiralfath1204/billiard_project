<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Menu Makanan & Minuman
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded-lg">

                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-xl font-bold">Daftar Menu</h1>
                    <a href="{{ route('products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                        + Tambah Menu
                    </a>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-3 rounded-lg mb-4">{{ session('success') }}</div>
                @endif

                <form method="GET" class="mb-4">
                    <select name="category" onchange="this.form.submit()" class="border rounded-lg px-3 py-2">
                        <option value="">-- Semua Kategori --</option>
                        <option value="makanan" {{ request('category') == 'makanan' ? 'selected' : '' }}>Makanan</option>
                        <option value="minuman" {{ request('category') == 'minuman' ? 'selected' : '' }}>Minuman</option>
                    </select>
                </form>

                <table class="w-full border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left">Gambar</th>
                            <th class="p-3 text-left">Nama</th>
                            <th class="p-3 text-left">Kategori</th>
                            <th class="p-3 text-left">Harga</th>
                            <th class="p-3 text-left">Stok</th>
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr class="border-b">
                            <td class="p-3">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="w-12 h-12 object-cover rounded-lg">
                                @else
                                    <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center text-xs text-gray-400">No Img</div>
                                @endif
                            </td>
                            <td class="p-3">{{ $product->name }}</td>
                            <td class="p-3">{{ ucfirst($product->category) }}</td>
                            <td class="p-3">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="p-3">{{ $product->stock }}</td>
                            <td class="p-3">
                                <span class="px-2 py-1 rounded-full text-xs
                                    {{ $product->status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ ucfirst($product->status) }}
                                </span>
                            </td>
                            <td class="p-3">
                                <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600 mr-2">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus menu ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="p-3 text-center text-gray-400">Belum ada menu.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $products->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>