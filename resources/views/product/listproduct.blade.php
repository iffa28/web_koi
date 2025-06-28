@php
    $showModal = request('show_checkout_modal') == '1' ? 'true' : 'false';
    $showDetailModal = request()->get('show_detail_modal') == '1';
    $trx = null;
    if ($showDetailModal && request()->has('transaksi_id')) {
        $trx = \App\Models\Transaksi::where('id', request('transaksi_id'))->where('user_id', Auth::id())->first();
    }
@endphp

<x-app-layout>
    <div x-data="{ openModal: false, selectedProduct: {}, qty: 1, total: 0, showForm: {{ $showModal }} }" class="bg-blue-900 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10">
            <h1 class="text-3xl font-bold text-white mb-10 text-center">Katalog Produk</h1>

            {{-- Grid Card --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                @forelse ($products as $product)
                    <div
                        class="bg-black bg-opacity-20 border dark:bg-blue-900 rounded-lg shadow-lg overflow-hidden hover:bg-opacity-30 hover:scale-105 transform transition-all duration-300">
                        @if ($product->gambar)
                            <img src="{{ route('product.image', $product->kode_produk) }}"
                                alt="{{ $product->nama_produk }}" class="w-full h-40 object-cover">
                        @else
                            <div class="w-full h-40 bg-gray-300 flex items-center justify-center text-gray-600">
                                No Image
                            </div>
                        @endif

                        <div class="p-4">
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-0 truncate">
                                {{ $product->nama_produk }}
                            </h2>
                            <div class="p-1 flex justify-between items-center">
                                <p class="text-green-600 font-bold text-md">
                                    Rp{{ number_format($product->harga_satuan, 0, ',', '.') }}
                                </p>
                                <button
                                    @click="selectedProduct = {{ json_encode($product) }}; openModal = true; qty = 1; total = {{ $product->harga_satuan }}"
                                    class="mt-1 w-6 bg-blue-600 text-white font-semibold py-0 rounded hover:bg-blue-700 transition-colors">
                                    +
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-5 text-center text-gray-100">Tidak ada produk tersedia.</div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-8">{{ $products->links() }}</div>

            {{-- Modal Tambah ke Keranjang --}}
            <div x-show="openModal"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 transition-opacity"
                x-transition:enter="transition ease-out duration-300"
                x-transition:leave="transition ease-in duration-200" x-cloak>
                <div @click.away="openModal = false" class="bg-white p-6 rounded-lg w-full max-w-md shadow-lg"
                    x-init="$watch('qty', value => total = selectedProduct.harga_satuan * qty)">
                    <h2 class="text-xl font-semibold mb-4">Tambah ke Keranjang</h2>
                    <form method="POST" action="{{ route('transaksi.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="text-sm text-gray-600">Nama Produk</label>
                            <input type="text" x-model="selectedProduct.nama_produk" disabled
                                class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100">
                        </div>
                        <div class="mb-3">
                            <label class="text-sm text-gray-600">Berat</label>
                            <input type="text" x-model="selectedProduct.berat" disabled
                                class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100">
                        </div>
                        <div class="mb-3">
                            <label class="text-sm text-gray-600">Jumlah</label>
                            <input type="number" name="qty" x-model="qty" min="1"
                                class="w-full border border-gray-300 rounded px-3 py-2">
                        </div>
                        <div class="mb-4">
                            <label class="text-sm text-gray-600">Total Harga</label>
                            <input type="text"
                                :value="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(total)"
                                readonly
                                class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100 text-green-600 font-semibold">
                        </div>
                        <input type="hidden" name="kode_produk" :value="selectedProduct.kode_produk">
                        <div class="flex justify-end">
                            <button type="button" @click="openModal = false"
                                class="mr-3 px-4 py-2 text-gray-700 border border-gray-300 rounded hover:bg-gray-200">
                                Batal
                            </button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                Masukkan ke Keranjang
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Modal Checkout --}}
            <div x-show="showForm" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" {{-- Latar belakang overlay dengan efek blur --}}
                class="fixed inset-0 z-50 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center p-4"
                x-cloak>

                {{-- Kontainer Modal --}}
                <div @click.away="showForm = false" x-show="showForm" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="bg-white dark:bg-gray-800 p-6 rounded-lg w-full max-w-lg shadow-xl">

                    {{-- Header Modal Baru --}}
                    <div class="flex items-center justify-between pb-3 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center">
                            {{-- Pastikan path logo ini benar --}}
                            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-auto mr-3">
                            <span class="font-bold text-xl text-gray-800 dark:text-gray-200">A3 KOI Farm</span>
                        </div>
                        {{-- Tombol close 'X' bisa dihapus karena sudah ada tombol Batal dan @click.away --}}
                    </div>

                    <h2 class="text-2xl font-bold my-4 text-gray-900 dark:text-gray-100">Checkout Pesanan</h2>

                    {{-- Form dengan styling baru --}}
                    <form method="POST" action="{{ route('transaksi.storeTransaksi') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="alamat"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat
                                    Lengkap</label>
                                <textarea name="alamat" id="alamat" required rows="3"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white resize-none"></textarea>
                            </div>
                            <div>
                                <label for="no_hp"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">No HP</label>
                                <input type="text" name="no_hp" id="no_hp" maxlength="13" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    placeholder="08xxxxxxxxxx">
                            </div>
                            <div>
                                <label for="bukti_transaksi"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Upload Bukti
                                    Pembayaran</label>
                                <input type="file" name="bukti_transaksi" id="bukti_transaksi" accept="image/*"
                                    required
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-600 dark:file:text-gray-200 dark:text-gray-400">
                            </div>
                        </div>

                        {{-- Tombol Aksi Baru (Pesan & Batal) --}}
                        <div class="flex justify-end gap-4 mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <button type="button" @click="showForm = false"
                                class="bg-red-600 hover:bg-gray-300 dark:bg-red-600 dark:hover:bg-gray-500 text-black dark:text-gray-200 font-bold py-2 px-6 rounded-lg transition-colors">
                                Batal
                            </button>
                            <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg transition-colors">
                                Pesan Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>


            {{-- Modal Detail Transaksi --}}
            @if ($trx)
                <div x-data="{ showDetail: true, copied: false }" x-show="showDetail"
                    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">

                    {{-- Card Modal --}}
                    <div @click.outside="showDetail = false"
                        class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden
                        transform transition-all"
                        x-show="showDetail" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">

                        <div class="p-8 text-center">
                            {{-- 1. Ikon Sukses --}}
                            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-green-100">
                                <svg class="h-8 w-8 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>

                            {{-- 2. Judul Konfirmasi --}}
                            <h2 class="mt-5 text-2xl font-bold text-gray-900">Transaksi Berhasil!</h2>
                            <p class="mt-2 text-sm text-gray-500">
                                Terima kasih, pembayaran Anda telah kami terima.
                            </p>

                            {{-- 3. Box Detail Transaksi --}}
                            <div class="mt-6 text-left border-t border-b border-gray-200 divide-y divide-gray-200">
                                <div class="py-3 flex justify-between text-sm">
                                    <span class="font-medium text-gray-500">Nama Produk</span>
                                    <span
                                        class="font-semibold text-gray-800">{{ $trx->produk->nama_produk ?? '-' }}</span>
                                </div>
                                <div class="py-3 flex justify-between text-sm">
                                    <span class="font-medium text-gray-500">Jumlah</span>
                                    <span class="font-semibold text-gray-800">{{ $trx->qty }}</span>
                                </div>
                                <div class="py-3 flex justify-between text-sm">
                                    <span class="font-medium text-gray-500">Berat</span>
                                    <span class="font-semibold text-gray-800">{{ $trx->berat }} gr</span>
                                </div>
                                <div class="py-3 flex justify-between text-sm">
                                    <span class="font-medium text-gray-500">No. HP</span>
                                    <span class="font-semibold text-gray-800">{{ $trx->no_hp }}</span>
                                </div>
                                <div class="py-3 flex justify-between items-start text-sm gap-4">
                                    <span class="font-medium text-gray-500 flex-shrink-0">Alamat</span>
                                    <span class="font-semibold text-gray-800 text-right">{{ $trx->alamat }}</span>
                                </div>
                                <div class="py-3 flex justify-between text-sm">
                                    <span class="font-medium text-gray-500">Total Harga</span>
                                    <span
                                        class="font-bold text-lg text-green-600">Rp{{ number_format($trx->total_harga, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            {{-- 4. Tombol Aksi Final --}}
                            <div class="mt-8">
                                <a href="{{ route('product.listproduct') }}"
                                    class="w-full inline-block px-8 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300">
                                    Selesai
                                </a>
                            </div>
                        </div>
                        {{-- Tombol Close 'X' dibuat lebih subtle --}}
                        <button @click="showDetail = false"
                            class="absolute top-4 right-4 text-gray-300 hover:text-gray-500 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            @endif


        </div>
    </div>
</x-app-layout>
