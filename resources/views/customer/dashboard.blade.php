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
                    <p class="mt-2 text-gray-600">Terima kasih telah berbelanja di A3 KOI Farm. Jelajahi koleksi ikan koi terbaik kami.</p>

                    <div class="mt-6">
                        <a href="{{ route('product.listproduct') }}"
                            class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                            Lihat Koleksi Produk
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Transaksi Aktif --}}
        @if ($transaksis->isNotEmpty())
            @php
                $totalAktif = $transaksis->count();
                $menunggu = $transaksis->where('status', 'menunggu pengiriman')->count();
                $dikirim = $transaksis->where('status', 'dikirim')->count();
            @endphp

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5">
                <button onclick="document.getElementById('modalList').classList.remove('hidden')"
                    class="bg-white text-blue-700 w-full px-6 py-4 rounded-lg shadow-md hover:bg-blue-50 font-semibold">
                    <div class="flex justify-between items-center">
                        🛒 {{ $totalAktif }} Pesanan Anda
                        <span class="text-sm text-gray-600">
                            ({{ $menunggu }} menunggu pengiriman, {{ $dikirim }} dikirim)
                        </span>
                        <p class="ml-2">&gt;</p>
                    </div>
                </button>
            </div>
        @endif
    </div>

    {{-- Modal List Transaksi Aktif --}}
    <div id="modalList" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white w-full max-w-2xl p-6 rounded-lg shadow-lg overflow-y-auto max-h-[80vh] relative">
            <h3 class="text-lg font-semibold mb-4">Daftar Transaksi Aktif</h3>
            <button onclick="document.getElementById('modalList').classList.add('hidden')"
                class="absolute top-3 right-4 text-gray-600 hover:text-red-500 text-2xl">&times;</button>

            @foreach ($transaksis as $trx)
                <div class="w-full border-b border-gray-200 py-3 px-3 flex justify-between items-center hover:bg-gray-100 transition rounded">
                    <div>
                        <h4 class="text-md font-bold">{{ $trx->produk->nama_produk ?? '-' }}</h4>
                        <p class="text-sm text-gray-500">Kode: {{ $trx->kode_produk }}</p>
                        <p class="text-sm">Jumlah: {{ $trx->qty }} | Total: Rp {{ number_format($trx->total_harga) }}</p>
                        <p class="text-sm text-gray-600">Status: 
                            <span class="{{ $trx->status === 'menunggu pengiriman' ? 'text-yellow-700' : 'text-blue-700' }}">
                                {{ ucfirst($trx->status) }}
                            </span>
                        </p>
                    </div>

                    @if ($trx->status === 'dikirim')
                        <form action="{{ route('transaksi.selesai', $trx->id) }}" method="POST" class="ml-4">
                            @csrf
                            @method('PATCH')
                            <button type="submit" onclick="return confirm('Yakin ingin menandai sebagai selesai?')"
                                class="bg-green-600 hover:bg-green-700 text-white py-1 px-3 rounded-md text-sm">
                                Tandai Selesai
                            </button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
