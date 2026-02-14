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
        Schema::create('fasilitas_properti', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('properti_id')->constrained('propertis')->cascadeOnDelete();
            $table->foreignUuid('fasilitas_id')->constrained('fasilitas')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasilitas_properti');
    }
};
