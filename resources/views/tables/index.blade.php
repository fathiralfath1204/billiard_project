<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Meja Billiard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Daftar Meja</h3>
                    <a href="{{ route('tables.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                        + Tambah Meja
                    </a>
                </div>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">No Meja</th>
                                <th class="px-6 py-3">Tipe</th>
                                <th class="px-6 py-3">Harga / Jam</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tables as $table)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $table->number_table }}</td>
                                    <td class="px-6 py-4">{{ $table->type }}</td>
                                    <td class="px-6 py-4">Rp {{ number_format($table->price_per_hour, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs rounded-full {{ $table->status == 'available' ? 'bg-green-100 text-green-800' : ($table->status == 'occupied' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                            {{ ucfirst($table->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center flex justify-center items-center space-x-4">
                                        <!-- Logika Tombol Mulai Sewa / Penanda Terpakai -->
                                        @if($table->status == 'available')
                                            <a href="{{ route('bookings.create', ['table_id' => $table->id]) }}" class="inline-flex items-center px-2.5 py-1 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wider hover:bg-blue-700 active:bg-blue-900 focus:outline-none transition ease-in-out duration-150">
                                                Mulai Sewa
                                            </a>
                                        @else
                                            <span class="text-xs text-red-500 dark:text-red-400 font-bold uppercase tracking-wider">
                                                Sedang Main
                                            </span>
                                        @endif

                                        <span class="text-gray-300 dark:text-gray-600">|</span>

                                        <a href="{{ route('tables.edit', $table->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 text-xs font-semibold uppercase">Edit</a>
                                        
                                        <form action="{{ route('tables.destroy', $table->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus meja ini?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 text-xs font-semibold uppercase">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada data meja biliar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-800 leading-tight tracking-tight flex items-center">
            <span class="mr-2">⚙️</span> {{ __('Manajemen Meja Billiard') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex flex-col sm:flex-row justify-between sm:items-center mb-8 gap-4">
                <div>
                    <h3 class="text-xl font-black text-slate-800 tracking-tight">Tata Letak & Status Meja</h3>
                    <p class="text-xs text-slate-400">Kelola operasional dan status penggunaan meja biliar secara real-time.</p>
                </div>
                <a href="{{ route('tables.create') }}" class="inline-flex justify-center items-center px-5 py-2.5 bg-indigo-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 shadow-md shadow-indigo-200 transition duration-150">
                    + Tambah Meja Baru
                </a>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm font-semibold flex items-center shadow-sm">
                    <span class="mr-2">✅</span> {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($tables as $table)
                    <div class="bg-white rounded-2xl shadow-md border border-slate-100 overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                        
                        <div class="px-5 py-3.5 flex justify-between items-center {{ $table->status == 'available' ? 'bg-emerald-500' : 'bg-rose-500' }} text-white">
                            <span class="font-black text-md tracking-wide">{{ $table->number_table }}</span>
                            <span class="px-2.5 py-0.5 text-[10px] font-black uppercase tracking-wider bg-white/20 rounded-full">
                                {{ $table->status == 'available' ? 'Available' : 'Occupied' }}
                            </span>
                        </div>

                        <div class="p-6 space-y-4">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-slate-400 font-medium">Tipe Spesifikasi:</span>
                                <span class="font-bold text-slate-700 bg-slate-100 px-2 py-0.5 rounded text-xs">{{ $table->type }}</span>
                            </div>
                            <div class="flex justify-between items-center text-sm border-b border-slate-50 pb-3">
                                <span class="text-slate-400 font-medium">Tarif Sewa:</span>
                                <span class="font-extrabold text-indigo-600 text-base">Rp {{ number_format($table->price_per_hour, 0, ',', '.') }}<span class="text-xs text-slate-400 font-normal">/jam</span></span>
                            </div>

                            <div class="pt-2">
                                @if($table->status == 'available')
                                    <a href="{{ route('bookings.create', ['table_id' => $table->id]) }}" class="w-full inline-flex justify-center items-center px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs uppercase tracking-wider rounded-xl transition shadow-md shadow-emerald-100">
                                        ⚡ Mulai Sewa Meja
                                    </a>
                                @else
                                    <div class="w-full py-2.5 bg-rose-50 border border-rose-100 text-center rounded-xl">
                                        <span class="text-xs font-black text-rose-600 uppercase tracking-widest animate-pulse">🔴 Sedang Digunakan</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="px-6 py-3 bg-slate-50 border-t border-slate-100 flex justify-end space-x-3 text-xs">
                            <a href="{{ route('tables.edit', $table->id) }}" class="text-slate-500 hover:text-indigo-600 font-bold uppercase tracking-wider transition">Edit</a>
                            <span class="text-slate-300">|</span>
                            <form action="{{ route('tables.destroy', $table->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus meja ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-slate-400 hover:text-rose-600 font-bold uppercase tracking-wider transition">Hapus</button>
                            </form>
                        </div>

                    </div>
                @forelse
                    <div class="col-span-full p-12 text-center bg-white rounded-2xl border border-dashed border-slate-200">
                        <span class="text-4xl block mb-2">📥</span>
                        <p class="text-slate-500 text-sm font-medium">Belum ada data meja biliar yang terdaftar di sistem.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>