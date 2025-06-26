<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Menampilkan dasbor yang sesuai berdasarkan role pengguna.
     */
    public function index(): View
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // Jika pengguna adalah admin, tampilkan view dasbor admin
            return view('admin.dashboard');
        }

        // Jika bukan admin (misalnya customer), tampilkan view dasbor customer
        return view('customer.dashboard');
    }
}