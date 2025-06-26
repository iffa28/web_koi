<x-app-layout>

    <div class="bg-blue-900 min-h-screen -mt-16 pt-16">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
            {{-- Judul Utama Halaman --}}
            <h1 class="text-6xl font-bold text-white mb-8">Manajemen Transaksi</h1>

            {{-- Container utama Alpine.js untuk mengelola modal --}}
            <div x-data="{
                proofModalOpen: false,
                proofImageUrl: ''
            }">

                <h1 class="text-2xl font-bold text-white mb-8">Daftar Riwayat Transaksi</h1>

                {{-- Container Tabel diubah ke tema gelap --}}
                <div class="bg-black bg-opacity-20 rounded-lg shadow-md overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        {{-- Header tabel disesuaikan dengan tema gelap --}}
                        <thead class="bg-black bg-opacity-25">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-blue-200 uppercase tracking-wider">
                                    Kode
                                    Produk</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-blue-200 uppercase tracking-wider">
                                    Nama
                                    Produk</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-blue-200 uppercase tracking-wider">
                                    Qty
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-blue-200 uppercase tracking-wider">
                                    Total
                                    Harga</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-blue-200 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-blue-200 uppercase tracking-wider">
                                    Bukti Transaksi</th>
                            </tr>
                        </thead>
                        {{-- Body tabel disesuaikan dengan tema gelap --}}
                        <tbody class="divide-y divide-white/10">
                            @forelse ($orders as $order)
                                <tr>
                                    {{-- Warna teks diubah menjadi terang --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-200">
                                        {{ $order->kode_produk }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">
                                        {{ $order->produk->nama_produk ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">{{ $order->qty }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">
                                        Rp{{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold">
                                        {{-- Badge Status disesuaikan agar kontras --}}
                                        <span @class([
                                            'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
                                            'bg-green-500 text-white' => $order->status === 'selesai',
                                            'bg-red-500 text-white' => $order->status === 'dibatalkan',
                                            'bg-blue-500 text-white' => !in_array($order->status, [
                                                'selesai',
                                                'dibatalkan',
                                            ]),
                                        ])>
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                        @if ($order->bukti_transaksi)
                                            <button type="button"
                                                @click="
                                            proofModalOpen = true; 
                                            proofImageUrl = '{{ route('adminTransaksi.image', $order->id) }}';
                                        "
                                                class="text-white bg-indigo-600 hover:bg-indigo-700 px-3 py-1 rounded-md text-xs">
                                                Lihat Bukti
                                            </button>
                                        @else
                                            <span class="text-xs text-gray-500">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-400">
                                        Tidak ada riwayat transaksi untuk ditampilkan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Paginasi disesuaikan dengan tema gelap --}}
                    <div class="p-4 border-t border-white/10">
                        {{ $orders->links() }}
                    </div>
                </div>

                {{-- Modal untuk melihat bukti transaksi (tidak ada perubahan) --}}
                <div x-show="proofModalOpen" ...>


                    {{-- ========================================================== --}}
                    {{-- MODAL UNTUK MELIHAT BUKTI TRANSAKSI --}}
                    {{-- ========================================================== --}}
                    <div x-show="proofModalOpen" x-transition
                        class="fixed inset-0 z-50 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center"
                        x-cloak>
                        <div @click.away="proofModalOpen = false"
                            class="bg-white rounded-lg shadow-xl p-4 w-full max-w-lg">
                            <div class="flex justify-end mb-2">
                                <button @click="proofModalOpen = false" class="text-gray-400 hover:text-gray-600">
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <div class="w-full">
                                <img :src="proofImageUrl" alt="Bukti Transaksi"
                                    class="max-w-full max-h-[80vh] mx-auto rounded">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
