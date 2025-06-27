<x-app-layout>
    {{-- Kita tidak lagi memerlukan header slot karena judul utama ada di konten --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- Dikosongkan --}}
        </h2>
    </x-slot>

    <div class="text-center">
        {{-- Judul Utama --}}
        <h1 class="text-5xl font-bold text-white tracking-wider" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
            SELAMAT DATANG
        </h1>
        {{-- Sub-judul --}}
        <p class="mt-2 text-xl text-gray-300">
            Di Admin Toko A3 KOI Farm
        </p>
    </div>

    {{-- Container untuk Grid Kartu Navigasi --}}
    <div class="mt-12">
        {{-- Grid dibuat responsif: 1 kolom di layar kecil, 2 di medium, 4 di besar --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

            {{-- KARTU 1: MANAJEMEN PRODUK --}}
            <a href="{{ route('product.index') }}"
                class="block p-8 bg-black bg-opacity-20 rounded-xl shadow-lg hover:bg-opacity-30 hover:scale-105 transform transition-all duration-300">
                <div class="flex flex-col items-center justify-center text-center">
                    {{-- Ikon --}}
                    <div class="w-20 h-20 flex items-center justify-center bg-blue-500 bg-opacity-50 rounded-full mb-4">
                        <svg class="w-10 h-10 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25ZM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25Z" />
                        </svg>
                    </div>
                    {{-- Teks --}}
                    <h3 class="text-xl font-semibold text-white">Manajemen Produk</h3>
                </div>
            </a>

            {{-- KARTU 2: MANAJEMEN PENGGUNA --}}
            <a href="{{ route('user.index') }}"
                class="block p-8 bg-black bg-opacity-20 rounded-xl shadow-lg hover:bg-opacity-30 hover:scale-105 transform transition-all duration-300">
                <div class="flex flex-col items-center justify-center text-center">
                    <div class="w-20 h-20 flex items-center justify-center bg-blue-500 bg-opacity-50 rounded-full mb-4">
                        <svg class="w-10 h-10 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-4.67c.62.91 1.074 1.96 1.074 3.071v.003z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white">Manajemen Pengguna</h3>
                </div>
            </a>

            {{-- KARTU 3: MANAJEMEN PESANAN --}}
            <a href="{{ route('adminPesanan.index') }}"
                class="block p-8 bg-black bg-opacity-20 rounded-xl shadow-lg hover:bg-opacity-30 hover:scale-105 transform transition-all duration-300">
                <div class="flex flex-col items-center justify-center text-center">
                    <div class="w-20 h-20 flex items-center justify-center bg-blue-500 bg-opacity-50 rounded-full mb-4">
                        <svg class="w-10 h-10 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.658-.463 1.243-1.117 1.243H4.252c-.654 0-1.187-.585-1.117-1.243l1.263-12A3.75 3.75 0 017.5 4.5h9a3.75 3.75 0 013.75 3.75V8.517z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white">Manajemen Pesanan</h3>
                </div>
            </a>

            {{-- KARTU 4: MANAJEMEN TRANSAKSI --}}
            <a href="{{ route('adminTransaksi.index') }}"
                class="block p-8 bg-black bg-opacity-20 rounded-xl shadow-lg hover:bg-opacity-30 hover:scale-105 transform transition-all duration-300">
                <div class="flex flex-col items-center justify-center text-center">
                    <div class="w-20 h-20 flex items-center justify-center bg-blue-500 bg-opacity-50 rounded-full mb-4">
                        <svg class="w-10 h-10 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white">Manajemen Transaksi</h3>
                </div>
            </a>

            {{-- KARTU 5: CHAT --}}
            <a href="{{ route('chat.adminmessages') }}"
                class="block p-8 bg-black bg-opacity-20 rounded-xl shadow-lg hover:bg-opacity-30 hover:scale-105 transform transition-all duration-300">
                <div class="flex flex-col items-center justify-center text-center">
                    <div class="w-20 h-20 flex items-center justify-center bg-blue-500 bg-opacity-50 rounded-full mb-4">
                        <svg class="w-6 h-6 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white">Chat Customer</h3>
                </div>
            </a>

        </div>
    </div>
</x-app-layout>
