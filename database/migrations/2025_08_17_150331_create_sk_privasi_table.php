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
        Schema::create('sk_privasi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('judul');
            $table->enum('kategori', ['syarat-ketentuan', 'kebijakan-privasi'])->nullable();
            $table->text('isi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sk_privasi');
    }
};
