<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
});

// update data remove and make admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::post('/products', [ProductController::class, 'store'])->name('product.store');
    Route::delete('/product/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('/product/{product:kode_produk}/json', [ProductController::class, 'showJson'])->name('product.showJson');
    Route::post('/product/{product:kode_produk}', [ProductController::class, 'update'])->name('product.update');
});

require __DIR__ . '/auth.php';
