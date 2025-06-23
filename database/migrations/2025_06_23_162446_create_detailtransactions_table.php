<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detailtransactions', function (Blueprint $table) {
            $table->id();
            // Foreign key ke tabel transactions
            $table->foreignId('transaction_id')
                ->constrained('transactions')
                ->onDelete('cascade');
            
            $table->text('alamat');
            $table->string('no_hp', 13);
            $table->dateTime('waktu_transaksi');
            $table->binary('bukti_transaksi')->nullable();

            $table->timestamps();
        });
        DB::statement("ALTER TABLE detailtransactions MODIFY bukti_transaksi LONGBLOB");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailtransactions');
    }
};
