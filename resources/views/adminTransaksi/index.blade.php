<x-app-layout>
    <div class="bg-gray-100 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10">
            <h1 class="text-3xl font-bold text-gray-800 mb-10 text-center">Riwayat Transaksi</h1>

            @if ($orders->count() > 0)
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase">Kode Produk</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase">Nama Produk</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase">Qty</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase">Total Harga</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase">Bukti Transaksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-800">{{ $order->kode_produk }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-800">{{ $order->produk->nama_produk ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-800">{{ $order->qty }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-800">
                                        Rp{{ number_format($order->total_harga, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-semibold 
                                        @if ($order->status == 'selesai') text-green-600 
                                        @elseif ($order->status == 'dibatalkan') text-red-600 
                                        @else text-blue-600 
                                        @endif">
                                        {{ ucfirst($order->status) }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800">
                                        @if ($order->bukti_transaksi)
                                            <img src="{{ route('adminTransaksi.image', $order->id) }}"
                                                alt="{{ $order->nama_produk }}"
                                                class="w-16 h-16 object-cover rounded">
                                        @else
                                            <span class="text-xs text-gray-400">No Image</span>
                                        @endif
                                       
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="p-4">
                        {{ $orders->links() }}
                    </div>
                </div>
            @else
                <div class="text-center text-gray-600">
                    <p>Tidak ada transaksi untuk ditampilkan.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
