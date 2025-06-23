@php
    $showModal = request('show_checkout_modal') == '1' ? 'true' : 'false';
@endphp


<x-app-layout>
    <div x-data="{ openModal: false, selectedProduct: {}, qty: 1, total: 0, showForm: {{ $showModal }} }" class="bg-blue-900 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10">
            <h1 class="text-3xl font-bold text-white mb-10 text-center">Katalog Produk</h1>

            {{-- Grid Card --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                @forelse ($products as $product)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                        {{-- Gambar --}}
                        @if ($product->gambar)
                            <img src="{{ route('product.image', $product->kode_produk) }}"
                                alt="{{ $product->nama_produk }}" class="w-full h-40 object-cover">
                        @else
                            <div class="w-full h-40 bg-gray-300 flex items-center justify-center text-gray-600">
                                No Image
                            </div>
                        @endif

                        {{-- Info Produk --}}
                        <div class="p-4">
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-2 truncate">
                                {{ $product->nama_produk }}
                            </h2>
                            <p class="text-green-600 font-bold text-md">
                                Rp{{ number_format($product->harga_satuan, 0, ',', '.') }}
                            </p>

                            {{-- Tombol --}}
                            <button
                                @click="selectedProduct = {{ json_encode($product) }}; openModal = true; qty = 1; total = {{ $product->harga_satuan }}"
                                class="mt-4 w-full bg-blue-600 text-white font-semibold py-2 rounded hover:bg-blue-700 transition-colors">
                                Tambah ke Keranjang
                            </button>


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

                        <div id="modalDetail"
                            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
                            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                                <h2 class="text-lg font-semibold mb-4">Detail Transaksi</h2>
                                <p><strong>Nama Produk:</strong> <span id="modalNama"></span></p>
                                <p><strong>Jumlah:</strong> <span id="modalQty"></span></p>
                                <p><strong>Berat:</strong> <span id="modalBerat"></span></p>
                                <p><strong>Alamat:</strong> <span id="modalAlamat"></span></p>
                                <p><strong>No HP:</strong> <span id="modalNoHP"></span></p>
                                <p><strong>Total Harga:</strong> <span id="modalHarga"></span></p>

                                <div class="mt-4 text-right">
                                    <button onclick="document.getElementById('modalDetail').classList.add('hidden')"
                                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Tutup</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        {{-- Modal Checkout --}}
        <div x-show="showForm" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
            x-transition:enter="transition ease-out duration-300" x-transition:leave="transition ease-in duration-200"
            x-cloak>
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg" @click.away="showForm = false">
                <h2 class="text-xl font-semibold mb-4">Checkout</h2>
                <form method="POST" action="{{ route('transaksi.storeTransaksi') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm text-gray-600">Alamat Lengkap</label>
                        <textarea name="alamat" required rows="3" class="w-full border border-gray-300 rounded px-3 py-2"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm text-gray-600">No HP</label>
                        <input type="text" name="no_hp" maxlength="13" required
                            class="w-full border border-gray-300 rounded px-3 py-2" />
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm text-gray-600">Upload Bukti Pembayaran</label>
                        <input type="file" name="bukti_transaksi" accept="image/*"
                            class="w-full border border-gray-300 rounded px-3 py-2" required>
                    </div>

                    <div class="flex justify-end">
                        <button type="button" @click="showForm = false"
                            class="mr-3 px-4 py-2 text-gray-600 border border-gray-300 rounded hover:bg-gray-200">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            Finish
                        </button>
                    </div>
                </form>
            </div>
        </div>


    </div>



</x-app-layout>
