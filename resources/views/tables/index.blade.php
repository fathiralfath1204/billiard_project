<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-800 dark:text-slate-200 leading-tight tracking-tight flex items-center">
            <span class="mr-2">⚙️</span> {{ __('Manajemen Meja Billiard') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-slate-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Header Atas & Tombol Tambah -->
            <div class="flex flex-col sm:flex-row justify-between sm:items-center mb-8 gap-4">
                <div>
                    <h3 class="text-xl font-black text-slate-800 dark:text-gray-100 tracking-tight">Tata Letak & Status Meja</h3>
                    <p class="text-xs text-slate-400 dark:text-gray-400">Kelola operasional dan status penggunaan meja biliar secara real-time.</p>
                </div>
                <a href="{{ route('tables.create') }}" class="inline-flex justify-center items-center px-5 py-2.5 bg-indigo-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 shadow-md shadow-indigo-200 dark:shadow-none transition duration-150">
                    + Tambah Meja Baru
                </a>
            </div>

            <!-- Notifikasi Sukses -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-400 rounded-xl text-sm font-semibold flex items-center shadow-sm">
                    <span class="mr-2">✅</span> {{ session('success') }}
                </div>
            @endif

            <!-- TAMPILAN GRID INTERAKTIF ALA MEJA REALTIME -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($tables as $table)
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-slate-100 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                        
                        <!-- Status Bar Atas Card -->
                        <div class="px-5 py-3.5 flex justify-between items-center {{ $table->status == 'available' ? 'bg-emerald-500' : 'bg-rose-500' }} text-white">
                            <span class="font-black text-md tracking-wide">{{ $table->number_table }}</span>
                            <span class="px-2.5 py-0.5 text-[10px] font-black uppercase tracking-wider bg-white/20 rounded-full">
                                {{ $table->status == 'available' ? 'Available' : 'Occupied' }}
                            </span>
                        </div>

                        <!-- Isi Detail Meja -->
                        <div class="p-6 space-y-4">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-slate-400 dark:text-gray-400 font-medium">Tipe Spesifikasi:</span>
                                <span class="font-bold text-slate-700 dark:text-gray-200 bg-slate-100 dark:bg-gray-700 px-2 py-0.5 rounded text-xs">{{ $table->type }}</span>
                            </div>
                            <div class="flex justify-between items-center text-sm border-b border-slate-50 dark:border-gray-700 pb-3">
                                <span class="text-slate-400 dark:text-gray-400 font-medium">Tarif Sewa:</span>
                                <span class="font-extrabold text-indigo-600 dark:text-indigo-400 text-base">
                                    Rp {{ number_format($table->price_per_hour, 0, ',', '.') }}<span class="text-xs text-slate-400 dark:text-gray-500 font-normal">/jam</span>
                                </span>
                            </div>

                            <!-- Tombol Utama Aksi Sewa -->
                            <div class="pt-2">
                                @if($table->status == 'available')
                                    <a href="{{ route('bookings.create', ['table_id' => $table->id]) }}" class="w-full inline-flex justify-center items-center px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs uppercase tracking-wider rounded-xl transition shadow-md shadow-emerald-100 dark:shadow-none">
                                        ⚡ Mulai Sewa Meja
                                    </a>
                                @else
                                    <div class="w-full py-2.5 bg-rose-50 dark:bg-rose-950/30 border border-rose-100 dark:border-rose-900 text-center rounded-xl">
                                        <span class="text-xs font-black text-rose-600 dark:text-rose-400 uppercase tracking-widest animate-pulse">🔴 Sedang Digunakan</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Footer Aksi Edit / Hapus -->
                        <div class="px-6 py-3 bg-slate-50 dark:bg-gray-750 border-t border-slate-100 dark:border-gray-700 flex justify-end space-x-3 text-xs">
                            <a href="{{ route('tables.edit', $table->id) }}" class="text-slate-500 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-indigo-400 font-bold uppercase tracking-wider transition">Edit</a>
                            <span class="text-slate-300 dark:text-gray-600">|</span>
                            <form action="{{ route('tables.destroy', $table->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus meja ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-slate-400 hover:text-rose-600 dark:text-gray-500 dark:hover:text-rose-400 font-bold uppercase tracking-wider transition">Hapus</button>
                            </form>
                        </div>

                    </div>
                @empty
                    <!-- Tampilan Jika Data Meja Kosong -->
                    <div class="col-span-full p-12 text-center bg-white dark:bg-gray-800 rounded-2xl border border-dashed border-slate-200 dark:border-gray-700">
                        <span class="text-4xl block mb-2">📥</span>
                        <p class="text-slate-500 dark:text-gray-400 text-sm font-medium">Belum ada data meja biliar yang terdaftar di sistem.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>