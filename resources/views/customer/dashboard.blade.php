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
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h3 class="text-xl font-semibold mb-4 text-white text-center mt-5">----------------  Transaksi Aktif Anda  ----------------</h3>
                <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 space-y-4">
                    @foreach ($transaksis as $trx)
                        <div class="bg-white rounded-xl shadow-lg p-4 border border-gray-200 hover:bg-opacity-30/2 hover:scale-105 shadow-lg rounded-lg transition duration-300 ease-in-out 
                                   transform hover:-translate-y-1 hover:shadow-xl">
                            <div class="p-1 flex justify-between items-center">
                                <div class="text-gray-900">
                                    <h4 class="text-lg font-bold mb-1">{{ $trx->produk->nama_produk ?? '-' }}</h4>
                                    <p class="text-sm text-gray-600 mb-2">Kode: <span
                                            class="font-mono">{{ $trx->kode_produk }}</span>
                                    </p>
                                </div>
                                <div class="text-gray-900">
                                    <span
                                        class="inline-block px-2 py-1 rounded-full text-xs font-medium text-left
                                    {{ $trx->status === 'menunggu pengiriman' ? 'bg-yellow-200 text-yellow-800' : 'bg-blue-200 text-blue-800' }}">
                                        {{ ucfirst($trx->status) }}
                                    </span>

                                    @if ($trx->status === 'dikirim')
                                        <form action="{{ route('transaksi.selesai', $trx->id) }}" method="POST"
                                            class="mt-4">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-2 rounded-md text-sm font-semibold transition-colors"
                                                onclick="return confirm('Yakin ingin menandai sebagai selesai?')">
                                                Tandai Selesai
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-app-layout>