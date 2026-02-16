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
        Schema::table('properti_tipe_kamar', function (Blueprint $table) {
            $table->integer('luas_kamar')->nullable()->after('jumlah_kamar');
            $table->string('tipe_bed')->nullable()->after('luas_kamar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properti_tipe_kamar', function (Blueprint $table) {
            $table->dropColumn(['luas_kamar', 'tipe_bed']);
        });
    }
};
