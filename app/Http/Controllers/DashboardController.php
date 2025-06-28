<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{

    public function index(): View
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('admin.dashboard');
        }

        $transaksis = Transaksi::with('produk') // pastikan eager load relasi produk
        ->where('user_id', Auth::id())
        ->whereIn('status', ['menunggu pengiriman', 'dikirim'])
        ->get();

        return view('customer.dashboard', compact('transaksis'));
    }
}
