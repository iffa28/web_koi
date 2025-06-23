<x-app-layout>
    <div class="bg-blue-900 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10">
            <h1 class="text-3xl font-bold text-white mb-10 text-center">Katalog Produk</h1>

            {{-- Grid Card 5 Kolom --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                @forelse ($products as $product)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                        {{-- Gambar Produk --}}
                        @if ($product->gambar)
                            <img src="{{ route('product.image', $product->kode_produk) }}" alt="{{ $product->nama_produk }}"
                                class="w-full h-40 object-cover">
                        @else
                            <div class="w-full h-40 bg-gray-300 flex items-center justify-center text-gray-600">
                                No Image
                            </div>
                        @endif

                        {{-- Detail Produk --}}
                        <div class="p-4">
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-2 truncate">
                                {{ $product->nama_produk }}
                            </h2>
                            <p class="text-green-600 font-bold text-md">
                                Rp{{ number_format($product->harga_satuan, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-5 text-center text-gray-100">
                        Tidak ada produk tersedia.
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
