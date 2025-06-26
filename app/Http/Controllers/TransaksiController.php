<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'kode_produk' => 'required|exists:products,kode_produk',
            'qty' => 'required|integer|min:1',
        ]);

        $product = Product::where('kode_produk', $request->kode_produk)->firstOrFail();

        // Cek apakah qty melebihi stok
        if ($request->qty > $product->stok) {
            return back()->withErrors(['qty' => 'Jumlah melebihi stok yang tersedia.']);
        }

        $total_harga = $product->harga_satuan * $request->qty;

        // Buat transaksi
        $transaksi = Transaksi::create([
            'user_id' => Auth::id(),
            'kode_produk' => $product->kode_produk,
            'nama_produk' => $product->nama_produk,
            'berat' => $product->berat,
            'qty' => $request->qty,
            'total_harga' => $total_harga,
            'status' => 'belum dibayar',
        ]);

        // Kurangi stok produk
        $product->stok -= $request->qty;
        $product->save();

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function destroy(Transaksi $transaksi)
    {
        if ($transaksi->status !== 'belum dibayar') {
            return redirect()->route('cart.index')->with('error', 'Hanya transaksi yang belum dibayar yang dapat dihapus.');
        }

        DB::beginTransaction();

        try {
            // Kembalikan stok produk
            $product = Product::where('kode_produk', $transaksi->kode_produk)->firstOrFail();
            $product->stok += $transaksi->qty;
            $product->save();

            // Hapus transaksi
            $transaksi->delete();

            DB::commit();

            return redirect()->route('cart.index')->with('success', 'Transaksi berhasil dihapus dan stok dikembalikan.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('cart.index')->with('error', 'Terjadi kesalahan saat menghapus transaksi.');
        }
    }

    public function storeTransaksi(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string',
            'no_hp' => 'required|string',
            'bukti_transaksi' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan gambar (binary)
        $binaryImage = null;
        if ($request->hasFile('bukti_transaksi')) {
            $binaryImage = file_get_contents($request->file('bukti_transaksi')->getRealPath());
        }

        // Ambil semua transaksi "belum dibayar" user saat ini
        $transaksiIds = Transaksi::where('user_id', Auth::id())
            ->where('status', 'belum dibayar')
            ->pluck('id');

        // Update semua jadi "menunggu konfirmasi"
        Transaksi::whereIn('id', $transaksiIds)->update([
            'status' => 'menunggu pengiriman',
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'bukti_transaksi' => $binaryImage,
        ]);


        return redirect()->route('product.listproduct', ['transaksi_id' => $transaksiIds->first()])
            ->with('success', 'Pesanan berhasil diproses.');
    }

    public function riwayatTransaksi()
    {
        $riwayat = Transaksi::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('history.index', compact('riwayat'));
    }
    public function tandaiSelesai($id)
    {
        $transaksi = Transaksi::where('id', $id)
            ->where('user_id', Auth::id()) // pastikan hanya user yang punya transaksi ini bisa ubah
            ->where('status', 'dikirim')
            ->firstOrFail();

        $transaksi->status = 'selesai';
        $transaksi->save();

        return redirect()->route('dashboard')->with('success', 'Transaksi berhasil ditandai sebagai selesai.');
    }
}
