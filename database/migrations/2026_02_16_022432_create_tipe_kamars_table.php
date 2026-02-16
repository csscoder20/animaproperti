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
        Schema::create('tipe_kamars', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama');
            $table->timestamps();
        });

        Schema::create('properti_tipe_kamar', function (Blueprint $table) {
            $table->foreignUuid('properti_id')->constrained('propertis')->cascadeOnDelete();
            $table->foreignUuid('tipe_kamar_id')->constrained('tipe_kamars')->cascadeOnDelete();
            $table->primary(['properti_id', 'tipe_kamar_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properti_tipe_kamar');
        Schema::dropIfExists('tipe_kamars');
    }
};
