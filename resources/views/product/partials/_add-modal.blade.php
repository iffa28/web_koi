{{-- ========================================================== --}}
{{-- MODAL TAMBAH PRODUK (sebelumnya bernama 'modalOpen') --}}
{{-- ========================================================== --}}
<div x-show="addModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" {{-- Latar belakang overlay dengan efek blur --}}
    class="fixed inset-0 z-50 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center" x-cloak>
    {{-- Kontainer Modal --}}
    <div @click.away="addModalOpen = false" x-show="addModalOpen" x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="bg-white dark:bg-gray-800 p-6 rounded-lg w-full max-w-lg shadow-xl">
        {{-- Header Modal Baru --}}
        <div class="flex items-center justify-between pb-3 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-auto mr-3">
                <span class="font-bold text-xl text-gray-800 dark:text-gray-200">A3 KOI Farm</span>
            </div>
        </div>

        <h2 class="text-2xl font-bold my-4 text-gray-900 dark:text-gray-100">Tambah Produk</h2>

        {{-- Form dengan styling baru --}}
        <form id="addProductForm" enctype="multipart/form-data">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="nama_produk" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama
                        Produk</label>
                    <input type="text" name="nama_produk" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                <div>
                    <label for="berat"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Berat</label>
                    <input type="text" name="berat" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                <div>
                    <label for="harga_satuan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga
                        Satuan</label>
                    <input type="number" name="harga_satuan" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                <div>
                    <label for="stok"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Stok</label>
                    <input type="number" name="stok" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                <div>
                    <label for="gambar" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gambar
                        Produk</label>
                    <input type="file" name="gambar" accept="image/*"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-600 dark:file:text-gray-200">
                </div>
            </div>

            {{-- Tombol Aksi Baru (Tambah & Batal) --}}
            <div class="flex justify-end gap-4 mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button type="button" @click="addModalOpen = false"
                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg transition-colors">
                    Batal
                </button>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition-colors">
                    Tambah
                </button>
            </div>
        </form>
    </div>
</div>
