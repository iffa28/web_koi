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
        Schema::table('transactions', function (Blueprint $table) {
            $table->text('alamat')->nullable()->after('status');
            $table->string('no_hp', 13)->nullable()->after('alamat');
            $table->binary('bukti_transaksi')->nullable()->after('no_hp');
        });

        DB::statement("ALTER TABLE transactions MODIFY bukti_transaksi LONGBLOB");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['alamat', 'no_hp', 'bukti_transaksi']);
        });
    }
};
