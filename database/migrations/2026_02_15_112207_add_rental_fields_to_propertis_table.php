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
        Schema::table('propertis', function (Blueprint $table) {
            // Toggle untuk disewa per kamar
            $table->boolean('disewa_per_kamar')->default(false)->after('unggulan');
            
            // Harga sewa per malam
            $table->decimal('harga_sewa_per_malam', 15, 2)->nullable()->after('disewa_per_kamar');
            
            // Tanggal ketersediaan untuk sewa per kamar
            $table->date('tersedia_dari_kamar')->nullable()->after('harga_sewa_per_malam');
            $table->date('tersedia_sampai_kamar')->nullable()->after('tersedia_dari_kamar');
            
            // Kapasitas tamu per kamar
            $table->integer('kapasitas_dewasa_per_kamar')->nullable()->default(1)->after('tersedia_sampai_kamar');
            $table->integer('kapasitas_anak_per_kamar')->nullable()->default(0)->after('kapasitas_dewasa_per_kamar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('propertis', function (Blueprint $table) {
            $table->dropColumn([
                'disewa_per_kamar',
                'harga_sewa_per_malam',
                'tersedia_dari_kamar',
                'tersedia_sampai_kamar',
                'kapasitas_dewasa_per_kamar',
                'kapasitas_anak_per_kamar',
            ]);
        });
    }
};
