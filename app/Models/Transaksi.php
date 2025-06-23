<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Menyesuaikan nama tabel karena model bernama "Transaksi", tetapi tabelnya "transactions"
    protected $table = 'transactions';

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'user_id',
        'kode_produk',
        'qty',
        'total_harga',
        'status',
        'alamat',
        'no_hp',
        'bukti_transaksi',
    ];

    /**
     * Relasi ke Produk
     */
    public function produk()
    {
        return $this->belongsTo(Product::class, 'kode_produk', 'kode_produk');
    }

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
