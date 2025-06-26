<x-app-layout>
    <div class="bg-blue-900 min-h-screen -mt-16 pt-16">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">

            <h1 class="text-6xl font-bold text-white mb-8 text-center">Manajemen Produk</h1>

            {{-- Container utama Alpine.js, sekarang mengelola DUA modal --}}
            <div x-data="{
                addModalOpen: false,
                deleteModalOpen: false,
                deleteFormId: '',
            
                editModalOpen: false,
                editingProduct: {},
                editFormAction: '',
            }">
                {{-- Header List Produk & Tombol Tambah --}}
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold text-white">List Produk</h2>
                    <button @click="addModalOpen = true"
                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                        Tambah Produk
                    </button>
                </div>

                {{-- Container Tabel --}}
                <div class="bg-black bg-opacity-20 rounded-lg shadow-md overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        {{-- ... thead ... --}}
                        <thead class="bg-black bg-opacity-25">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-blue-200 uppercase tracking-wider">
                                    Kode Produk</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-blue-200 uppercase tracking-wider">
                                    Nama Produk</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-blue-200 uppercase tracking-wider">
                                    Berat</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-blue-200 uppercase tracking-wider">
                                    Harga</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-blue-200 uppercase tracking-wider">
                                    Foto Produk</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-blue-200 uppercase tracking-wider">
                                    Stok</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-blue-200 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/10">
                            @forelse ($products as $index => $product)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-200">
                                        {{ $product->kode_produk }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-200">
                                        {{ $product->nama_produk }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-200">
                                        {{ $product->berat }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-200">
                                        Rp{{ number_format($product->harga_satuan, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if ($product->gambar)
                                            <img src="{{ route('product.image', $product->kode_produk) }}"
                                                alt="{{ $product->nama_produk }}"
                                                class="w-16 h-16 object-cover rounded">
                                        @else
                                            <span class="text-xs text-gray-400">No Image</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-200">
                                        {{ $product->stok }}</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium flex items-center space-x-2">
                                        <button type="button"
                                            @click="
                                            editModalOpen = true; 
                                            fetch('{{ route('product.showJson', $product) }}')
                                                .then(res => res.json())
                                                .then(data => { editingProduct = data; });
                                            editFormAction = '{{ route('product.update', $product) }}';
                                        "
                                            class="text-white bg-yellow-500 hover:bg-yellow-600 px-3 py-1 rounded-md">Edit</button>

                                        {{-- Form hapus diberi id unik berdasarkan kode produk --}}
                                        <form id="delete-form-{{ $product->kode_produk }}"
                                            action="{{ route('product.destroy', $product->kode_produk) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')

                                            {{-- Tombol Hapus diubah menjadi type="button" dan memanggil modal --}}
                                            <button type="button"
                                                @click="deleteModalOpen = true; deleteFormId = 'delete-form-{{ $product->kode_produk }}'"
                                                class="text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded-md">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                        Tidak ada produk yang ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- ... div paginasi ... --}}
                </div>

                @include('product.partials._add-modal')
                @include('product.partials._edit-modal')
                @include('product.partials._delete-modal')

            </div>
        </div>

        {{-- Script untuk form submission tambah produk tidak perlu diubah --}}
        <script>
            // Menunggu sampai seluruh halaman (termasuk modal) selesai dimuat
            document.addEventListener('DOMContentLoaded', function() {

                // --- SCRIPT UNTUK FORM TAMBAH PRODUK ---
                const addProductForm = document.getElementById('addProductForm');
                if (addProductForm) {
                    addProductForm.addEventListener('submit', function(event) {
                        event.preventDefault();
                        let form = event.target;
                        let formData = new FormData(form);
                        let submitButton = form.querySelector('button[type="submit"]');

                        submitButton.disabled = true;
                        submitButton.innerText = 'Menyimpan...';

                        fetch("{{ route('product.store') }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json',
                            },
                            body: formData
                        })
                        .then(response => {
                            if (!response.ok) { return response.json().then(err => { throw err; }); }
                            return response.json();
                        })
                        .then(data => {
                            if (data.message) {
                                alert(data.message);
                                location.reload();
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan. Periksa console untuk detail.');
                            submitButton.disabled = false;
                            submitButton.innerText = 'Tambah';
                        });
                    });
                }

                // --- SCRIPT UNTUK FORM EDIT PRODUK ---
                const editProductForm = document.getElementById('editProductForm');
                if (editProductForm) {
                    editProductForm.addEventListener('submit', function(event) {
                        event.preventDefault();
                        let form = event.target;
                        let formData = new FormData(form);
                        // Kita tidak perlu lagi menambahkan _method di sini, karena sudah ada @method('PATCH') di form
                        
                        // Ambil URL dari atribut 'action' pada form yang nilainya di-update oleh Alpine.js
                        let actionUrl = form.getAttribute('action'); 
                        let submitButton = form.querySelector('button[type="submit"]');
                        
                        submitButton.disabled = true;
                        submitButton.innerText = 'Menyimpan...';

                        fetch(actionUrl, {
                            method: 'POST', // Form method spoofing Laravel akan menangani ini
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json',
                            },
                            body: formData
                        })
                        .then(response => {
                            if (!response.ok) { return response.json().then(err => { throw err; }); }
                            return response.json();
                        })
                        .then(data => {
                            if (data.message) {
                                alert(data.message);
                                location.reload();
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat memperbarui produk.');
                            submitButton.disabled = false;
                            submitButton.innerText = 'Simpan Perubahan';
                        });
                    });
                }
            });
        </script>
</x-app-layout>
