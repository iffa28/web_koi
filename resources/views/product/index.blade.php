<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Header & Tombol Tambah -->
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-100">Daftar Produk</h3>
                <button onclick="toggleModal(true)"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded shadow">
                    + Tambah Produk
                </button>
            </div>

            <!-- Tabel Produk -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-x-auto">
                <table class="min-w-full text-sm text-gray-800 dark:text-gray-100">
                    <thead class="bg-gray-100 dark:bg-gray-700 text-left">
                        <tr>
                            <th class="px-4 py-2">Kode</th>
                            <th class="px-4 py-2">Nama</th>
                            <th class="px-4 py-2">Berat</th>
                            <th class="px-4 py-2">Stok</th>
                            <th class="px-4 py-2">Harga</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($products as $product)
                            <tr>
                                <td class="px-4 py-2">{{ $product->kode_produk }}</td>
                                <td class="px-4 py-2">{{ $product->nama_produk }}</td>
                                <td class="px-4 py-2">{{ $product->berat }}</td>
                                <td class="px-4 py-2">{{ $product->stok }}</td>
                                <td class="px-4 py-2">Rp{{ number_format($product->harga_satuan, 0, ',', '.') }}</td>
                                <td class="px-4 py-2">
                                    <form action="{{ route('product.destroy', $product->kode_produk) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">
                                    Tidak ada produk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="p-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Produk -->
    <div id="modal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg w-full max-w-xl shadow-lg relative">
            <button onclick="toggleModal(false)"
                class="absolute top-2 right-3 text-xl font-bold text-gray-600">&times;</button>
            <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Tambah Produk</h2>

            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="space-y-4">
                    <div>
                        <label for="nama_produk" class="block text-sm font-medium">Nama Produk</label>
                        <input type="text" name="nama_produk" required
                            class="w-full mt-1 p-2 rounded border dark:bg-gray-700 dark:text-white">
                    </div>
                    <div>
                        <label for="berat" class="block text-sm font-medium">Berat</label>
                        <input type="text" name="berat" required
                            class="w-full mt-1 p-2 rounded border dark:bg-gray-700 dark:text-white">
                    </div>
                    <div>
                        <label for="stok" class="block text-sm font-medium">Stok</label>
                        <input type="number" name="stok" required
                            class="w-full mt-1 p-2 rounded border dark:bg-gray-700 dark:text-white">
                    </div>
                    <div>
                        <label for="harga_satuan" class="block text-sm font-medium">Harga Satuan</label>
                        <input type="number" name="harga_satuan" required
                            class="w-full mt-1 p-2 rounded border dark:bg-gray-700 dark:text-white">
                    </div>
                    <div>
                        <label for="gambar" class="block text-sm font-medium">Gambar Produk</label>
                        <input type="file" name="gambar" accept="image/*"
                            class="w-full mt-1 p-2 rounded border dark:bg-gray-700 dark:text-white">
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script Toggle Modal -->
    <script>
        function toggleModal(show) {
            document.getElementById('modal').classList.toggle('hidden', !show);
        }
    </script>
</x-app-layout>
