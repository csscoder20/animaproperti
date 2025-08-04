<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgenPropertiTable extends Migration
{
    public function up(): void
    {
        Schema::create('agen_properti', function (Blueprint $table) {
            $table->uuid('agen_id');
            $table->uuid('properti_id');
            $table->timestamps();

            $table->foreign('agen_id')->references('id')->on('agens')->onDelete('cascade');
            $table->foreign('properti_id')->references('id')->on('propertis')->onDelete('cascade');

            $table->primary(['agen_id', 'properti_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agen_properti');
    }
}
