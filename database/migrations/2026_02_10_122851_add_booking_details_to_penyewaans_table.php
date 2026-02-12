<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('penyewaans', function (Blueprint $table) {
            $table->date('check_in')->nullable()->after('nama_penyewaan');
            $table->date('check_out')->nullable()->after('check_in');
            $table->integer('jumlah_kamar')->default(1)->after('check_out');
            $table->integer('jumlah_tamu')->default(1)->after('jumlah_kamar');
            $table->bigInteger('harga_per_kamar')->default(0)->after('jumlah_tamu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penyewaans', function (Blueprint $table) {
            $table->dropColumn(['check_in', 'check_out', 'jumlah_kamar', 'jumlah_tamu', 'harga_per_kamar']);
        });
    }
};
