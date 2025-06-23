{{-- ========================================================== --}}
{{-- MODAL BARU UNTUK KONFIRMASI HAPUS --}}
{{-- ========================================================== --}}
<div x-show="deleteModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center" x-cloak>
    <div @click.away="deleteModalOpen = false"
        class="bg-white dark:bg-gray-800 rounded-lg shadow-xl text-center p-8 w-full max-w-sm">
        <div class="w-20 h-20 mx-auto bg-red-100 rounded-full flex items-center justify-center mb-4">
            <span class="text-5xl text-red-500">!</span>
        </div>

        <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">Apakah yakin untuk
            menghapus Produk?</h3>

        <div class="flex justify-center gap-4 mt-6">
            {{-- Tombol Batal: Menutup modal --}}
            <button @click="deleteModalOpen = false"
                class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-8 rounded-lg transition-colors">
                Batal
            </button>

            {{-- Tombol Iya: Menjalankan submit pada form yang sesuai --}}
            <button @click="document.getElementById(deleteFormId).submit(); deleteModalOpen = false;"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-8 rounded-lg transition-colors">
                Iya
            </button>
        </div>
    </div>
</div>
