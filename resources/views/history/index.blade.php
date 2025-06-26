<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">
        <h1 class="text-3xl font-bold mb-6">Riwayat Transaksi</h1>

        @if ($riwayat->isEmpty())
            <p class="text-gray-600">Belum ada riwayat transaksi.</p>
        @else
            <div class="bg-white rounded-lg shadow overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">Kode Produk</th>
                            <th class="px-4 py-2">Produk</th>
                            <th class="px-4 py-2">Qty</th>
                            <th class="px-4 py-2">Total</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($riwayat as $item)
                            <tr>
                                <td class="px-4 py-2">{{ $item->kode_produk }}</td>
                                <td class="px-4 py-2">{{ $item->produk->nama_produk }}</td>
                                <td class="px-4 py-2">{{ $item->qty }}</td>
                                <td class="px-4 py-2">Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                <td class="px-4 py-2 capitalize">{{ $item->status }}</td>
                                <td class="px-4 py-2 text-sm text-gray-500">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
