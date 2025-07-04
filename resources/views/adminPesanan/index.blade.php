<x-app-layout>

    <div class="bg-blue-900 min-h-screen -mt-16 pt-16">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
            {{-- Judul Utama Halaman --}}
            <h1 class="text-6xl font-bold text-white mb-8">Manajemen Pesanan</h1>

            {{-- Container utama Alpine.js untuk mengelola modal --}}
            <div x-data="{
                updateStatusModalOpen: false,
                resiModalOpen: false,
                formAction: '',
                modalTitle: '',
                modalMessage: '',
                newStatus: '',
                openResiModal(action, id) {
                    this.resiFormAction = action;
                    this.transactionId = id;
                    this.resiModalOpen = true;
                }
            }">

                {{-- Judul dan Sub-judul Halaman --}}
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-2xl font-semibold text-white">Daftar Pesanan Masuk</h1>
                </div>

                {{-- Container Tabel - Dibuat scrollable di layar kecil untuk responsivitas --}}
                <div class="bg-black bg-opacity-20 rounded-lg shadow-md overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-black bg-opacity-25">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-blue-200 uppercase tracking-wider">
                                    Tanggal Transaksi</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-blue-200 uppercase tracking-wider">
                                    nama pengguna</th>
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
                                    class="px-6 py-3 text-left text-xs font-medium text-blue-200 uppercase tracking-wider">
                                    Alamat</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-blue-200 uppercase tracking-wider">
                                    No Hp
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-blue-200 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/10">
                            @forelse ($orders as $order)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-200">
                                        {{ $order->created_at->format('d M Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-200">
                                        {{ $order->user->name ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-200">
                                        {{ $order->kode_produk }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-200">
                                        {{ $order->produk->nama_produk ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-200">
                                        {{ $order->qty }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-200">
                                        Rp{{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-200">
                                        {{-- Badge Status dengan warna berbeda --}}
                                        <span @class([
                                            'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
                                            'bg-yellow-100 text-yellow-800' => $order->status === 'menunggu konfirmasi',
                                            'bg-blue-100 text-blue-800' => $order->status === 'diproses',
                                            'bg-green-100 text-green-800' => $order->status === 'selesai',
                                            'bg-red-100 text-red-800' => $order->status === 'dibatalkan',
                                        ])>
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-200">
                                        {{ $order->alamat ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-200">
                                        {{ $order->no_hp ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-y-2">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-y-2">
                                        {{-- Tombol Batalkan --}}
                                        @if ($order->status === 'menunggu pengiriman')
                                            <button
                                                @click="updateStatusModalOpen = true;
                modalTitle = 'Batalkan Pesanan';
                modalMessage = 'Apakah kamu yakin ingin membatalkan pesanan ini?';
                formAction = '{{ route('adminPesanan.batalkanStatus', $order->id) }}';
                newStatus = 'dibatalkan';"
                                                class="text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded-md text-xs">
                                                Batalkan
                                            </button>
                                        @endif

                                        {{-- Tombol Selesaikan - hanya muncul jika status 'dikirim' --}}
                                        @if ($order->status === 'dikirim')
                                            <button
                                                @click="updateStatusModalOpen = true;
                modalTitle = 'Selesaikan Transaksi';
                modalMessage = 'Apakah kamu yakin ingin menyelesaikan pesanan ini?';
                formAction = '{{ route('adminPesanan.selesai', $order->id) }}';
                newStatus = 'selesai';"
                                                class="text-white bg-green-600 hover:bg-green-700 px-3 py-1 rounded-md text-xs">
                                                Selesaikan
                                            </button>
                                        @endif

                                        {{-- Tombol Kirim - hanya muncul jika status menunggu pengiriman --}}
                                        @if ($order->status === 'menunggu pengiriman')
                                            <button
                                                @click="openResiModal('{{ route('delivery.store') }}', '{{ $order->id }}')"
                                                class="text-white bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded-md text-xs">
                                                Kirim
                                            </button>
                                        @endif

                                        {{-- Jika belum dibayar --}}
                                        @if ($order->status === 'belum dibayar')
                                            <span class="text-gray-400 italic text-xs">Menunggu dibayar</span>
                                        @endif
                                    </td>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-4 text-center text-white">
                                        Tidak ada pesanan yang dapat di proses.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Paginasi --}}
                    <div class="p-4 border-t border-white/10">
                        {{ $orders->links() }}
                    </div>
                </div>

                {{-- ========================================================== --}}
                {{-- MODAL KONFIRMASI UPDATE STATUS --}}
                {{-- ========================================================== --}}
                <div x-show="updateStatusModalOpen" x-transition
                    class="fixed inset-0 z-50 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center"
                    x-cloak>
                    <div @click.away="updateStatusModalOpen = false"
                        class="bg-white rounded-lg shadow-xl text-center p-8 w-full max-w-sm">
                        <!-- Ikon Peringatan -->
                        <div class="w-20 h-20 mx-auto bg-blue-100 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-10 h-10 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                            </svg>
                        </div>

                        <!-- Teks Konfirmasi Dinamis -->
                        <h3 class="text-xl font-semibold text-gray-900 mb-2" x-text="modalTitle"></h3>
                        <p class="text-gray-600" x-text="modalMessage"></p>

                        <!-- Tombol Aksi -->
                        <div class="flex justify-center gap-4 mt-6">
                            <button @click="updateStatusModalOpen = false"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-8 rounded-lg transition-colors">
                                Batal
                            </button>
                            <form :action="formAction" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" :value="newStatus">
                                <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-8 rounded-lg transition-colors">
                                    Iya
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal input resi -->
                <div x-show="resiModalOpen" x-transition
                    class="fixed inset-0 z-50 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center"
                    x-cloak>
                    <div @click.away="resiModalOpen = false" class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Masukkan Resi Pengiriman</h2>
                        <form :action="resiFormAction" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="transaction_id" :value="transactionId">

                            <div class="mb-4">
                                <label class="block text-gray-700 mb-1">Nomor Resi</label>
                                <input type="text" name="no_resi"
                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                                    required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 mb-1">Upload Resi (opsional)</label>
                                <input type="file" name="upload_resi" accept="image/*"
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                        file:rounded file:border-0 file:text-sm file:font-semibold
                        file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                            </div>

                            <div class="flex justify-end gap-4">
                                <button type="button" @click="resiModalOpen = false"
                                    class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 text-gray-800">Batal</button>
                                <button type="submit"
                                    class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
