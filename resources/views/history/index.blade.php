<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">
        {{-- Judul Utama Halaman --}}
        <h1 class="text-6xl font-bold text-white mb-8">Riwayat Transaksi</h1>

        @if ($riwayat->isEmpty())
            <p class="text-white">Belum ada riwayat transaksi.</p>
        @else
            <div class="bg-black bg-opacity-20 rounded-lg shadow-md overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-black bg-opacity-25">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Kode Produk</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Produk</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Qty</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Total</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10">
                        @foreach ($riwayat as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-200">{{ $item->kode_produk }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-200">{{ $item->produk->nama_produk }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-200">{{ $item->qty }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-200">Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-200 capitalize">{{ $item->status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-200 text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
