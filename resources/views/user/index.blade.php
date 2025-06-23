<x-app-layout>

    {{-- Wrapper Utama untuk Latar Belakang Biru --}}
    <div class="bg-blue-900 min-h-screen -mt-16 pt-16">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">

            {{-- Judul Utama Halaman --}}
            <h1 class="text-3xl font-bold text-white mb-8">Manajemen Pengguna</h1>

            {{-- Container utama Alpine.js untuk mengelola modal konfirmasi hapus --}}
            <div x-data="{
                deleteModalOpen: false,
                deleteFormId: ''
            }">

                {{-- Header List Customer --}}
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold text-white">Daftar Customer</h2>
                    {{-- Di sini bisa ditambahkan tombol 'Tambah Customer' jika diperlukan di masa depan --}}
                </div>

                {{-- Container Tabel - Dibuat scrollable di layar kecil untuk responsivitas --}}
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    #</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Nama</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Email</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Tanggal Daftar</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($users as $index => $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ $users->firstItem() + $index }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ $user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ $user->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ $user->created_at->format('d M Y H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        {{-- Form hapus diberi id unik berdasarkan id user --}}
                                        <form id="delete-form-{{ $user->id }}"
                                            action="{{ route('user.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            {{-- Tombol Hapus diubah menjadi type="button" dan memanggil modal --}}
                                            <button type="button"
                                                @click="deleteModalOpen = true; deleteFormId = 'delete-form-{{ $user->id }}'"
                                                class="text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded-md">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                        Tidak ada customer yang ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- Paginasi --}}
                    <div class="p-4 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                        {{ $users->links() }}
                    </div>
                </div>

                {{-- ========================================================== --}}
                {{-- MODAL KONFIRMASI HAPUS (disalin dari halaman produk) --}}
                {{-- ========================================================== --}}
                <div x-show="deleteModalOpen" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 z-50 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center"
                    x-cloak>
                    <div @click.away="deleteModalOpen = false"
                        class="bg-white dark:bg-gray-800 rounded-lg shadow-xl text-center p-8 w-full max-w-sm">
                        <div class="w-20 h-20 mx-auto bg-red-100 rounded-full flex items-center justify-center mb-4">
                            <span class="text-5xl text-red-500">!</span>
                        </div>

                        <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">Apakah yakin untuk
                            menghapus Pengguna ini?</h3>

                        <div class="flex justify-center gap-4 mt-6">
                            <button @click="deleteModalOpen = false"
                                class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-8 rounded-lg transition-colors">
                                Batal
                            </button>
                            <button @click="document.getElementById(deleteFormId).submit(); deleteModalOpen = false;"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-8 rounded-lg transition-colors">
                                Iya
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
