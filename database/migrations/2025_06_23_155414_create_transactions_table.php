<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('kode_produk');
            $table->foreign('kode_produk')->references('kode_produk')->on('products')->onDelete('cascade');
            $table->integer('qty');
            $table->unsignedBigInteger('total_harga');
            $table->enum('status', ['belum dibayar', 'dibatalakan', 'menunggu pengiriman', 'dikirim', 'selesai'])
                  ->default('belum dibayar');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
