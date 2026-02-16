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
        Schema::table('fasilitas_tipe_kamar', function (Blueprint $table) {
            // Drop the UUID 'id' column which lacks a default value
            $table->dropColumn('id');
            
            // Add a composite primary key
            $table->primary(['tipe_kamar_id', 'fasilitas_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fasilitas_tipe_kamar', function (Blueprint $table) {
            $table->dropPrimary(['tipe_kamar_id', 'fasilitas_id']);
            $table->uuid('id')->primary();
        });
    }
};
