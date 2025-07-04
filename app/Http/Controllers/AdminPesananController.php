<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPesananController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk admin.');
        }

        $orders = Transaksi::with('produk')
            ->whereIn('status', ['belum dibayar', 'menunggu pengiriman', 'dikirim'])
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        return view('adminPesanan.index', compact('orders'));
    }

    public function batalkanStatus($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk admin.');
        }

        $order = Transaksi::findOrFail($id);

        if (!in_array($order->status, ['menunggu pengiriman'])) {
        return redirect()->back()->with('error', 'Pesanan hanya dapat dibatalkan jika statusnya menunggu pengiriman atau belum dibayar.');
        }
        $order->status = 'dibatalkan';
        $order->save();

        return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan.');
    }
}
