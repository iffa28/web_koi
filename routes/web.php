<?php

use App\Http\Controllers\AdminPesananController;
use App\Http\Controllers\AdminTransaksiController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/listproduct', [ProductController::class, 'listproduct'])->name('product.listproduct');
    Route::get('/produk/{kode_produk}/gambar', [ProductController::class, 'showImage'])->name('product.image');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/transaction', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::delete('/cart/{transaksi}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
    Route::post('/listproduct/savetransaksi', [TransaksiController::class, 'storeTransaksi'])->name('transaksi.storeTransaksi');
    Route::patch('/transaksi/{id}/selesai', [TransaksiController::class, 'tandaiSelesai'])->name('transaksi.selesai');


    Route::get('/history', [TransaksiController::class, 'riwayatTransaksi'])->name('history.index');

    Route::get('/chat', [ChatController::class, 'startOrShow'])->name('chat.index');
    Route::get('/chat/{id}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{id}/send', [ChatController::class, 'sendMessage'])->name('chat.send');
});

// update data remove and make admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('/product', [ProductController::class, 'index'])->name('product.index');

    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    Route::delete('/product/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('/product/{product:kode_produk}/json', [ProductController::class, 'showJson'])->name('product.showJson');
    Route::patch('/product/{product}/adited', [ProductController::class, 'update'])->name('product.update');


    Route::get('/adminPesanan', [AdminPesananController::class, 'index'])->name('adminPesanan.index');
    Route::post('/adminPesanan/sentdelivery', [DeliveryController::class, 'store'])->name('delivery.store');
    Route::patch('/adminPesanan/{id}/batalkanpesanan', [AdminPesananController::class, 'batalkanStatus'])->name('adminPesanan.batalkanStatus');

    Route::get('/adminTransaksi', [AdminTransaksiController::class, 'index'])->name('adminTransaksi.index');
    Route::get('/adminTransaksi/{id}/bukti_transaksi', [AdminTransaksiController::class, 'showImage'])->name('adminTransaksi.image');
    Route::get('/Messages', [ChatController::class, 'index'])->name('chat.adminmessages');
});

require __DIR__ . '/auth.php';
