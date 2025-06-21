<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('kode_produk')->primary();      // ex: KOI001
            $table->string('nama_produk');
            $table->string('berat');                        // ex: "100-200 gram"
            $table->integer('stok');
            $table->decimal('harga_satuan', 10, 2);
            $table->binary('gambar')->nullable();             // will be modified to LONGBLOB
            $table->timestamps();
        });

        DB::statement("ALTER TABLE products MODIFY gambar LONGBLOB");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
