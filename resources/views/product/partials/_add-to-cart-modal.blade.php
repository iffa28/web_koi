{{-- resources/views/customer/partials/_add-to-cart-modal.blade.php --}}
<div x-show="cartModalOpen" x-transition
    class="fixed inset-0 z-50 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center p-4" x-cloak>
    {{-- Kontainer Modal --}}
    <div @click.away="cartModalOpen = false" x-show="cartModalOpen" x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="bg-blue-900 border border-blue-700 p-6 rounded-lg w-full max-w-md shadow-xl" {{-- Inisialisasi watcher untuk menghitung total harga secara dinamis --}}
        x-init="$watch('qty', value => {
            if (value < 1) qty = 1;
            total = selectedProduct.harga_satuan * qty;
        })">
        <div class="flex items-center justify-between pb-3 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Tambah ke Keranjang</h2>
        </div>

        <form method="POST" action="{{ route('transaksi.store') }}" class="mt-4">
            @csrf
            <div class="flex items-start">
                {{-- Gambar Produk di Modal --}}
                <img :src="`/produk/${selectedProduct.kode_produk}/gambar`" alt="Gambar Produk"
                    class="w-24 h-24 object-cover rounded-md flex-shrink-0 bg-gray-100">

                <div class="flex-grow ml-4">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white" x-text="selectedProduct.nama_produk">
                    </h3>
                    <p class="text-sm text-gray-500" x-text="selectedProduct.berat"></p>
                    <p class="text-lg font-bold text-green-600 mt-2"
                        x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(selectedProduct.harga_satuan)">
                    </p>
                </div>
            </div>

            <div class="mt-4 grid grid-cols-2 gap-4 items-end">
                <div>
                    <label for="qty"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah</label>
                    <input type="number" name="qty" id="qty" x-model="qty" min="1"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Total Harga</label>
                    <p class="text-xl font-bold text-gray-900 dark:text-white"
                        x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(total)">
                    </p>
                </div>
            </div>

            <input type="hidden" name="kode_produk" :value="selectedProduct.kode_produk">

            <div class="flex justify-end gap-4 mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button type="button" @click="cartModalOpen = false"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-6 rounded-lg transition-colors">
                    Batal
                </button>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition-colors">
                    Masukkan Keranjang
                </button>
            </div>
        </form>
    </div>
</div>
