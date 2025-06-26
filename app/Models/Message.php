<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';

    public $timestamps = false; // karena hanya ada created_at

    protected $fillable = [
        'chat_id',
        'sender_id',
        'isi_pesan',
        'created_at',
    ];

    protected $casts = [
    'created_at' => 'datetime',
];

    // 🔁 Relasi ke chat
    public function chat()
    {
        return $this->belongsTo(Chat::class, 'chat_id');
    }

    // 🔁 Relasi ke pengirim pesan (bisa admin atau user)
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}



