<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-semibold">Selamat Datang, {{ Auth::user()->name }}!</h3>
                    <p class="mt-2 text-gray-600">Terima kasih telah berbelanja di A3 KOI Farm. Jelajahi koleksi ikan koi
                        terbaik kami.</p>

                    <div class="mt-6">
                        <a href="#"
                            class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                            Lihat Koleksi Produk
                        </a>
                        <a href="#" class="ml-4 inline-block text-blue-600 hover:underline">
                            Riwayat Transaksi Anda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
