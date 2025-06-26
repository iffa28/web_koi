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

        {{-- Transaksi Aktif --}}
        @if ($transaksis->isNotEmpty())
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h3 class="text-xl font-semibold mb-4 text-gray-800">Transaksi Aktif Anda</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($transaksis as $trx)
                        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
                            <h4 class="text-lg font-bold mb-1">{{ $trx->nama_produk }}</h4>
                            <p class="text-sm text-gray-600 mb-2">Kode: <span class="font-mono">{{ $trx->kode_produk }}</span></p>
                            <p class="text-sm text-gray-700">Jumlah: <span class="font-semibold">{{ $trx->qty }}</span></p>
                            <p class="text-sm text-gray-700">Total: <span class="font-semibold">Rp{{ number_format($trx->total_harga, 0, ',', '.') }}</span></p>
                            <p class="text-sm mt-2">
                                Status:
                                <span class="inline-block px-2 py-1 rounded-full text-xs font-medium
                                    {{ $trx->status === 'menunggu pengiriman' ? 'bg-yellow-200 text-yellow-800' : 'bg-blue-200 text-blue-800' }}">
                                    {{ ucfirst($trx->status) }}
                                </span>
                            </p>

                            @if ($trx->status === 'dikirim')
                                <form action="{{ route('transaksi.selesai', $trx->id) }}" method="POST" class="mt-4">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-md text-sm font-semibold transition-colors"
                                        onclick="return confirm('Yakin ingin menandai sebagai selesai?')">
                                        Tandai Selesai
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
