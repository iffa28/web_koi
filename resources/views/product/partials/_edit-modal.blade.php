<div x-show="editModalOpen && editingProduct.nama_produk" x-transition
    class="fixed inset-0 z-50 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center" x-cloak>
    <div @click.away="editModalOpen = false" class="bg-white dark:bg-gray-800 p-6 rounded-lg w-full max-w-lg shadow-xl">
        <div class="flex items-center justify-between pb-3 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Edit Produk</h2>
            <button @click="editModalOpen = false" class="text-gray-400 hover:text-gray-600">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Form edit --}}
        <form id="editProductForm" :action="editFormAction" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="space-y-4 mt-4">
                <div>
                    <label for="edit_nama_produk" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                    <input type="text" name="nama_produk" id="edit_nama_produk" x-model="editingProduct.nama_produk"
                        required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label for="edit_berat" class="block text-sm font-medium text-gray-700">Berat</label>
                    <input type="text" name="berat" id="edit_berat" x-model="editingProduct.berat" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label for="edit_harga_satuan" class="block text-sm font-medium text-gray-700">Harga Satuan</label>
                    <input type="number" name="harga_satuan" id="edit_harga_satuan"
                        x-model="editingProduct.harga_satuan" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label for="edit_stok" class="block text-sm font-medium text-gray-700">Stok</label>
                    <input type="number" name="stok" id="edit_stok" x-model="editingProduct.stok" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label for="edit_gambar" class="block text-sm font-medium text-gray-700">Ganti Gambar
                        (Opsional)</label>
                    <input type="file" name="gambar" id="edit_gambar" accept="image/*"
                        class="mt-1 block w-full text-sm text-gray-500">
                    <div class="mt-2" x-show="editingProduct.kode_produk">
                        <img :src="`/produk/${editingProduct.kode_produk}/gambar`"
                            class="w-24 h-24 object-cover rounded">
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-4 mt-6 pt-4 border-t border-gray-200">
                <button type="button" @click="editModalOpen = false"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md">Batal</button>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">Simpan
                    Perubahan</button>
            </div>
        </form>
    </div>
</div>
