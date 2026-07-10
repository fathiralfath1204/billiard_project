<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Menu Makanan & Minuman
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between items-center mb-6">
                <h1 class="text-xl font-bold">Daftar Menu</h1>
                <a href="{{ route('products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">
                    + Tambah Menu
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded-lg mb-4">{{ session('success') }}</div>
            @endif

            <form method="GET" class="mb-6">
                <select name="category" onchange="this.form.submit()" class="border rounded-lg px-3 py-2 text-sm">
                    <option value="">-- Semua Kategori --</option>
                    <option value="makanan" {{ request('category') == 'makanan' ? 'selected' : '' }}>Makanan</option>
                    <option value="minuman" {{ request('category') == 'minuman' ? 'selected' : '' }}>Minuman</option>
                </select>
            </form>

            <div class="space-y-4">
                @forelse($products as $product)
                <div class="bg-white shadow rounded-xl flex items-center gap-5 p-4">

                    {{-- Gambar --}}
                    <div class="shrink-0">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 class="w-24 h-24 object-cover rounded-xl">
                        @else
                            <div class="w-24 h-24 bg-gray-100 rounded-xl flex flex-col items-center justify-center text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-xs">No Image</span>
                            </div>
                        @endif
                    </div>

                    {{-- Info --}}
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
                            <span class="text-xs px-2 py-0.5 rounded-full
                                {{ $product->category == 'makanan' ? 'bg-orange-100 text-orange-600' : 'bg-blue-100 text-blue-600' }}">
                                {{ ucfirst($product->category) }}
                            </span>
                        </div>
                        <p class="text-blue-600 font-bold text-lg">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <div class="flex items-center gap-4 mt-1 text-sm text-gray-500">
                            <span>Stok: <strong class="text-gray-700">{{ $product->stock }}</strong></span>
                            <span class="px-2 py-0.5 rounded-full text-xs
                                {{ $product->status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ ucfirst($product->status) }}
                            </span>
                        </div>
                    </div>

                    {{-- Aksi --}}
                    <div class="flex flex-col gap-2 shrink-0">
                        <a href="{{ route('products.edit', $product->id) }}"
                           class="bg-blue-50 text-blue-600 px-4 py-1.5 rounded-lg text-sm text-center hover:bg-blue-100">
                            Edit
                        </a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                              onsubmit="return confirm('Yakin hapus menu ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="w-full bg-red-50 text-red-600 px-4 py-1.5 rounded-lg text-sm hover:bg-red-100">
                                Hapus
                            </button>
                        </form>
                    </div>

                </div>
                @empty
                <div class="bg-white shadow rounded-xl p-8 text-center text-gray-400">
                    Belum ada menu. Klik "+ Tambah Menu" untuk menambahkan.
                </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $products->links() }}
            </div>

        </div>
    </div>
</x-app-layout>