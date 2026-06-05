<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-800 leading-tight tracking-tight flex items-center">
            <span class="mr-2">🎱</span> {{ __('Dashboard Kasir Billiard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Ucapan Selamat Datang Premium -->
            <div class="relative bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 overflow-hidden shadow-xl sm:rounded-2xl p-8 text-white transform transition-all duration-300 hover:scale-[1.01]">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-indigo-500 opacity-20 rounded-full blur-xl"></div>
                <div class="relative z-10">
                    <div class="text-white text-2xl font-black tracking-tight mb-2">
                        {{ __("Selamat Datang di Sistem Billiard Management!") }} 👋
                    </div>
                    <p class="text-indigo-200 text-sm max-w-xl font-medium leading-relaxed">
                        Gunakan menu di atas untuk mengelola meja dan mencatat transaksi booking billiard dengan mudah, cepat, dan akurat.
                    </p>
                </div>
            </div>

            <!-- KETENTUAN UAS: WIDGET INFORMASI DARI API EKSTERNAL DENGAN UI PREMIUM -->
            <div class="bg-white overflow-hidden shadow-md sm:rounded-2xl p-6 border-t-4 border-indigo-600 transition-all duration-300 hover:shadow-xl">
                <div class="flex flex-col md:flex-row md:justify-between md:items-center border-b border-slate-100 pb-4 mb-6">
                    <div>
                        <h3 class="text-md font-black text-slate-800 uppercase tracking-wider flex items-center">
                            <span class="text-indigo-600 mr-2">🌐</span> Widget Eksternal API: Kurs Mata Uang Global
                        </h3>
                        <p class="text-xs text-slate-400 mt-0.5">Data diambil realtime via Third-Party API (Ketentuan Nilai UAS)</p>
                    </div>
                    <div class="mt-2 md:mt-0">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-100 animate-pulse">
                            ● Update: {{ $lastUpdate }}
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-5 mt-2">
                    <!-- USD Card -->
                    <div class="p-5 bg-gradient-to-b from-slate-50 to-white rounded-xl border border-slate-100 shadow-sm text-center transition-all duration-200 hover:border-indigo-200 hover:shadow-md">
                        <span class="text-xs font-bold text-slate-400 block uppercase tracking-wider mb-1">🇺🇸 1 USD (Dollar AS)</span>
                        <span class="text-xl font-black text-slate-800">Rp {{ number_format($rates['USD'], 0, ',', '.') }}</span>
                    </div>
                    <!-- SGD Card -->
                    <div class="p-5 bg-gradient-to-b from-slate-50 to-white rounded-xl border border-slate-100 shadow-sm text-center transition-all duration-200 hover:border-indigo-200 hover:shadow-md">
                        <span class="text-xs font-bold text-slate-400 block uppercase tracking-wider mb-1">🇸🇬 1 SGD (Dollar Sgp)</span>
                        <span class="text-xl font-black text-slate-800">Rp {{ number_format($rates['SGD'], 0, ',', '.') }}</span>
                    </div>
                    <!-- EUR Card -->
                    <div class="p-5 bg-gradient-to-b from-slate-50 to-white rounded-xl border border-slate-100 shadow-sm text-center transition-all duration-200 hover:border-indigo-200 hover:shadow-md">
                        <span class="text-xs font-bold text-slate-400 block uppercase tracking-wider mb-1">🇪🇺 1 EUR (Euro)</span>
                        <span class="text-xl font-black text-slate-800">Rp {{ number_format($rates['EUR'], 0, ',', '.') }}</span>
                    </div>
                    <!-- AUD Card -->
                    <div class="p-5 bg-gradient-to-b from-slate-50 to-white rounded-xl border border-slate-100 shadow-sm text-center transition-all duration-200 hover:border-indigo-200 hover:shadow-md">
                        <span class="text-xs font-bold text-slate-400 block uppercase tracking-wider mb-1">🇦🇺 1 AUD (Dollar Aus)</span>
                        <span class="text-xl font-black text-slate-800">Rp {{ number_format($rates['AUD'], 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>