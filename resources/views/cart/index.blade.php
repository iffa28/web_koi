<x-app-layout>
    <div class="bg-gray-100 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10">
            <h1 class="text-3xl font-bold text-gray-800 mb-10 text-center">Keranjang Belanja</h1>

            @if ($carts->count() > 0)
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase">Kode Produk
                                </th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase">Nama Ikan
                                </th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase">Berat ikan
                                </th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase">Qty</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase">Total Harga
                                </th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($carts as $cart)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-800">{{ $cart->kode_produk }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-800">{{ $cart->produk->nama_produk }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-800">{{ $cart->produk->berat ?? '-' }} gram
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800">{{ $cart->qty }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-800">
                                        Rp{{ number_format($cart->total_harga, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-sm text-yellow-600 font-semibold">
                                        {{ ucfirst($cart->status) }}</td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('transaksi.destroy', $cart->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus transaksi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="p-4">
                        {{ $carts->links() }}
                        <div class="p-4 flex justify-end">
                            <a href="{{ route('product.listproduct', ['show_checkout_modal' => true]) }}"
                                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                Checkout
                            </a>
                        </div>

                    </div>
                </div>
            @else
                <div class="text-center text-gray-600">
                    <p>Keranjang kamu kosong.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
