<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|exists:transactions,transaction_id',
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

        return redirect()->route('AdminPesanan.index')->with('success', 'Resi berhasil ditambahkan.');
    }
}
