<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    // Menyesuaikan nama tabel karena model bernama "Transaksi", tetapi tabelnya "transactions"
    protected $table = 'deliveries';

    protected $fillable = [
        'transaction_id',
        'no_resi',
        'upload_resi',
    ];

    public function pengirimanProduk()
    {
        return $this->belongsTo(Transaksi::class, 'transaction_id', 'transaction_id');
    }
}
