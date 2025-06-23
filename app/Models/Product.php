<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'kode_produk';
    public $incrementing = false; // jika kode_produk bukan auto increment
    protected $keyType = 'string';
    protected $hidden = ['gambar'];

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
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'kode_produk', 'kode_produk');
    }

    public function getRouteKeyName()
    {
        return 'kode_produk';
    }
}
