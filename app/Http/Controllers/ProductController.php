<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {

        $products = Product::orderBy('created_at', 'desc')->paginate(10);

        return view('product.index', compact('products'));
    }

    public function listproduct()
    {
        $products = Product::orderBy('created_at', 'asc') // Urut berdasarkan tanggal dibuat
            ->select('kode_produk', 'nama_produk', 'berat', 'harga_satuan', 'gambar') // sertakan kode_produk untuk gambar
            ->paginate(10);

        return view('product.listproduct', compact('products'));
    }

    public function store(Request $request)
    {

        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Hanya admin yang bisa menambahkan produk'], 403);
        }

        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'berat' => 'required|string|max:50',
            'stok' => 'required|integer|min:0',
            'harga_satuan' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Ambil kode terakhir (misalnya KOI015)
        $lastProduct = Product::orderBy('kode_produk', 'desc')->first();

        if ($lastProduct) {
            $lastNumber = (int) substr($lastProduct->kode_produk, 3);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        // Format kode baru (misal: KOI001)
        $newKode = 'KOI' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // Simpan gambar (binary)
        $binaryImage = null;
        if ($request->hasFile('gambar')) {
            $binaryImage = file_get_contents($request->file('gambar')->getRealPath());
        }

        // Simpan ke database
        $product = Product::create([
            'kode_produk' => $newKode,
            'nama_produk' => $request->nama_produk,
            'berat' => $request->berat,
            'stok' => $request->stok,
            'harga_satuan' => $request->harga_satuan,
            'gambar' => $binaryImage,
        ]);

        return response()->json([
            'message' => 'Produk berhasil ditambahkan',
            'data' => [
                'kode_produk' => $product->kode_produk,
                'nama_produk' => $product->nama_produk,
                'harga_satuan' => $product->harga_satuan,
                // jangan sertakan 'gambar'
            ]
        ]);
    }
    public function showJson(Product $product)
    {
        return response()->json($product);
    }

    /**
     * Memproses update produk dari modal edit.
     */
    public function update(Request $request, Product $product)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Hanya admin yang bisa mengubah produk'], 403);
        }

        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'berat' => 'required|string|max:50',
            'stok' => 'required|integer|min:0',
            'harga_satuan' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // gambar tidak wajib saat update
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            $data['gambar'] = file_get_contents($request->file('gambar')->getRealPath());
        }

        $product->update($data);

        return redirect()->back()->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {

        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product deleted successfully!');
    }
    public function showImage($kode_produk)
    {
        $product = Product::where('kode_produk', $kode_produk)->firstOrFail();

        if ($product->gambar) {
            // Mengembalikan response dengan data gambar dan header Content-Type yang benar
            return response($product->gambar)->header('Content-Type', 'image/jpeg');
        }

        // Jika tidak ada gambar, kembalikan gambar placeholder atau 404
        // Di sini kita kembalikan 404 Not Found
        abort(404);
    }
}
