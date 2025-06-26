<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    use HasFactory;

    protected $table = 'chat';

    // Laravel tidak akan otomatis mengisi updated_at
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'admin_id',
        'created_at',
    ];

    // 🔁 Relasi ke user (customer)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // 🔁 Relasi ke admin
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // 🔁 Relasi ke pesan-pesan dalam chat
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
