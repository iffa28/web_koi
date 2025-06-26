{{-- resources/views/customer/partials/_order-detail-modal.blade.php --}}
<div x-show="detailModalOpen" x-transition
    class="fixed inset-0 z-50 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center p-4" x-cloak>
    <div @click.away="detailModalOpen = false" x-show="detailModalOpen" x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        class="bg-white p-6 rounded-lg w-full max-w-lg shadow-xl text-left">
        <div class="flex items-center justify-between pb-3 border-b">
            <h2 class="text-2xl font-bold text-gray-900">Pesanan Berhasil Dibuat!</h2>
            <button @click="detailModalOpen = false; window.location.href='{{ route('user.riwayat') }}';"
                class="text-gray-400 hover:text-gray-600">&times;</svg></button>
        </div>
        <p class="mt-4 text-gray-600">Terima kasih. Pesanan Anda sedang kami proses. Berikut adalah detailnya:</p>
        <div class="mt-4 space-y-2 border-t border-b py-4">
            <p><strong>Nama Produk:</strong> <span x-text="orderDetail.nama_produk"></span></p>
            <p><strong>Jumlah:</strong> <span x-text="orderDetail.qty"></span></p>
            <p><strong>Alamat Pengiriman:</strong> <span x-text="orderDetail.alamat"></span></p>
            <p><strong>No. HP:</strong> <span x-text="orderDetail.no_hp"></span></p>
            <p class="font-bold text-lg"><strong>Total Harga:</strong> <span
                    x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(orderDetail.total_harga)"></span>
            </p>
        </div>
        <div class="mt-6 text-right">
            <a href="{{ route('user.riwayat') }}" class="bg-blue-600 text-white font-bold py-2 px-6 rounded-lg">Lihat
                Riwayat Transaksi</a>
        </div>
    </div>
</div>
