<x-app-layout>
    <div class="bg-blue-900 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10">
            <h1 class="text-3xl font-bold text-white mb-10 text-center">Keranjang Belanja</h1>

            @if ($carts->count() > 0)
                <div class="bg-black bg-opacity-20 rounded-lg shadow-md overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-black bg-opacity-25">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-blue-200 uppercase tracking-wider">
                                    Kode Produk
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-blue-200 uppercase tracking-wider">
                                    Nama Ikan
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-blue-200 uppercase tracking-wider">
                                    Berat ikan
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-blue-200 uppercase tracking-wider">
                                    Qty</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-blue-200 uppercase tracking-wider">
                                    Total Harga
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-blue-200 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-blue-200 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($carts as $cart)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-200">
                                        {{ $cart->kode_produk }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-200">
                                        {{ $cart->produk->nama_produk }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-200">
                                        {{ $cart->produk->berat ?? '-' }} gram
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-200">
                                        {{ $cart->qty }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-200">
                                        Rp{{ number_format($cart->total_harga, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-sm text-yellow-600 font-semibold">
                                        {{ ucfirst($cart->status) }}</td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('transaksi.destroy', $cart->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus transaksi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded-md">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="p-4 flex justify-between items-center">

                        {{-- TOMBOL KIRI: Kembali ke Katalog --}}
                        <a href="{{ route('product.listproduct') }}"
                            class="px-6 py-2 bg-gray-200 text-gray-800 font-semibold rounded-lg shadow-md hover:bg-gray-300 transition-colors duration-300">
                            &larr; Kembali Belanja
                        </a>

                        {{-- TOMBOL KANAN: Checkout --}}
                        <a href="{{ route('product.listproduct', ['show_checkout_modal' => true]) }}"
                            class="px-6 py-2 bg-green-600 text-white font-bold rounded-lg shadow-md hover:bg-green-700 transition-colors duration-300">
                            Checkout &rarr;
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
