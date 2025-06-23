<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CheckoutController extends Controller
{
    /**
     * Ketika tombol checkout ditekan.
     * Redirect ke halaman listproduct dengan trigger modal.
     */
    public function redirectToProductWithModal()
    {
        return redirect()->route('product.index', ['showCheckoutModal' => true]);
    }

    /**
     * Setelah user isi form alamat + bukti pembayaran dan tekan "Finish"
     */
    public function finish(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string',
            'no_hp' => 'required|string',
            'bukti_pembayaran' => 'required|image|max:2048',
        ]);

        $buktiPath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        Transaksi::where('user_id', Auth::id())
            ->where('status', 'belum dibayar')
            ->update([
                'status' => 'menunggu konfirmasi',
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'bukti_pembayaran' => $buktiPath,
            ]);

        return redirect()->route('product.index')->with('success', 'Pesanan berhasil diproses.');
    }
}
