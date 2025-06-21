<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'berat',
        'stok',
        'harga_satuan',
        'gambar',
    ];

    /**
     * Relasi: produk bisa muncul dalam banyak transaksi (opsional)
     */
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'kode_produk', 'kode_produk');
    }

}
