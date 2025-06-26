<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'no_resi' => 'required|string|max:255',
            'upload_resi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $binaryImage = null;
        if ($request->hasFile('upload_resi')) {
            $binaryImage = file_get_contents($request->file('upload_resi')->getRealPath());
        }

        Delivery::create([
            'transaction_id' => $request->transaction_id,
            'no_resi' => $request->no_resi,
            'upload_resi' => $binaryImage,
        ]);

        Transaksi::where('id', $request->transaction_id)
            ->update(['status' => 'dikirim']);

        return redirect()->route('adminPesanan.index')->with('success', 'Resi berhasil ditambahkan.');
    }

    public function showImage($id)
    {
        $delivery = Delivery::where('id', $id)->firstOrFail();

        if ($delivery->upload_resi) {
            // Mengembalikan response dengan data gambar dan header Content-Type yang benar
            return response($delivery->upload_resi)->header('Content-Type', 'image/jpeg');
        }

        abort(404);
    }
}
