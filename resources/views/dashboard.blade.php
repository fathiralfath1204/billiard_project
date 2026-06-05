<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Kasir Billiard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="text-gray-900 text-lg font-bold">
                    {{ __("Selamat Datang di Sistem Billiard Management!") }}
                </div>
                <p class="text-sm text-gray-500 mt-1">Gunakan menu di atas untuk mengelola meja dan mencatat transaksi booking billiard.</p>
            </div>

            <!-- KETENTUAN UAS: KOTAK INFORMASI DARI API EKSTERNAL -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-indigo-500">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h3 class="text-md font-bold text-gray-800 uppercase tracking-wider">🌐 Widget Eksternal API: Kurs Mata Uang Global</h3>
                        <p class="text-xs text-gray-400">Data diambil realtime via Third-Party API (Ketentuan Nilai UAS)</p>
                    </div>
                    <span class="text-xs bg-indigo-100 text-indigo-800 px-2.5 py-0.5 rounded-full font-medium">Update: {{ $lastUpdate }}</span>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-2">
                    <div class="p-4 bg-gray-50 rounded-lg border text-center">
                        <span class="text-xs font-bold text-gray-400 block">🇺🇸 1 USD (Dollar AS)</span>
                        <span class="text-lg font-extrabold text-gray-700">Rp {{ number_format($rates['USD'], 0, ',', '.') }}</span>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg border text-center">
                        <span class="text-xs font-bold text-gray-400 block">🇸🇬 1 SGD (Dollar Sgp)</span>
                        <span class="text-lg font-extrabold text-gray-700">Rp {{ number_format($rates['SGD'], 0, ',', '.') }}</span>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg border text-center">
                        <span class="text-xs font-bold text-gray-400 block">🇪🇺 1 EUR (Euro)</span>
                        <span class="text-lg font-extrabold text-gray-700">Rp {{ number_format($rates['EUR'], 0, ',', '.') }}</span>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg border text-center">
                        <span class="text-xs font-bold text-gray-400 block">🇦🇺 1 AUD (Dollar Aus)</span>
                        <span class="text-lg font-extrabold text-gray-700">Rp {{ number_format($rates['AUD'], 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>