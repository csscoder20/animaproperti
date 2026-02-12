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
        Schema::table('propertis', function (Blueprint $table) {
            $table->integer('jumlah_kamar')->default(1)->after('jumlah_kamar_mandi');
            $table->integer('kapasitas_tamu')->default(1)->after('jumlah_kamar');
            $table->date('tersedia_dari')->nullable()->after('kapasitas_tamu');
            $table->date('tersedia_sampai')->nullable()->after('tersedia_dari');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('propertis', function (Blueprint $table) {
            $table->dropColumn(['jumlah_kamar', 'kapasitas_tamu', 'tersedia_dari', 'tersedia_sampai']);
        });
    }
};
