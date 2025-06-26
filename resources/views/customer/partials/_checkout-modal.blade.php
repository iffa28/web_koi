{{-- resources/views/customer/partials/_checkout-modal.blade.php --}}
<div x-show="checkoutModalOpen" x-transition class="fixed inset-0 z-50 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center p-4" x-cloak>
    <div @click.away="checkoutModalOpen = false" x-show="checkoutModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="bg-white p-6 rounded-lg w-full max-w-lg shadow-xl">
        <div class="flex items-center justify-between pb-3 border-b">
            <h2 class="text-2xl font-bold text-gray-900">Formulir Checkout</h2>
            <button @click="checkoutModalOpen = false" class="text-gray-400 hover:text-gray-600">&times;</svg></button>
        </div>
        <form id="checkoutForm" @submit.prevent="submitCheckout" class="mt-4">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                    <textarea name="alamat" id="alamat" required rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                </div>
                <div>
                    <label for="no_hp" class="block text-sm font-medium text-gray-700">No. Handphone</label>
                    <input type="text" name="no_hp" id="no_hp" required maxlength="15" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div>
                    <label for="bukti_transaksi" class="block text-sm font-medium text-gray-700">Upload Bukti Pembayaran</label>
                    <input type="file" name="bukti_transaksi" id="bukti_transaksi" required accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>
            </div>
            <div class="flex justify-end gap-4 mt-6 pt-4 border-t">
                <button type="button" @click="checkoutModalOpen = false" class="bg-gray-200 text-gray-800 font-bold py-2 px-6 rounded-lg">Batal</button>
                <button type="submit" class="bg-green-600 text-white font-bold py-2 px-6 rounded-lg">Kirim Pesanan</button>
            </div>
        </form>
    </div>
</div>