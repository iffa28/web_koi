<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminTransaksiController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk admin.');
        }

        $orders = Transaksi::with('produk', 'user')
            ->whereIn('status', ['dibatalkan', 'selesai', 'dikirimkan']) // ✅ hanya status tertentu
            ->select('id', 'kode_produk', 'qty', 'total_harga', 'status', 'bukti_transaksi', 'created_at', 'user_id')
            ->paginate(10);

        return view('adminTransaksi.index', compact('orders'));
    }

    public function showImage($id)
    {
        $order = Transaksi::where('id', $id)->firstOrFail();

        if ($order->bukti_transaksi) {
            // Mengembalikan response dengan data gambar dan header Content-Type yang benar
            return response($order->bukti_transaksi)->header('Content-Type', 'image/jpeg');
        }

        // Jika tidak ada gambar, kembalikan gambar placeholder atau 404
        // Di sini kita kembalikan 404 Not Found
        abort(404);
    }
}
