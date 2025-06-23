<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Transaksi::with('produk') // muat relasi produk
            ->where('user_id', Auth::id())
            ->where('status', 'belum dibayar')
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        return view('cart.index', compact('carts'));
    }
}
