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

        // Ambil transaksi user yang status-nya menunggu pengiriman atau dikirim
        $transaksis = Transaksi::where('user_id', $user->id)
            ->whereIn('status', ['menunggu pengiriman', 'dikirim'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('customer.dashboard', compact('transaksis'));
    }
}
