<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyImagesTable extends Migration
{
    public function up()
    {
        Schema::create('property_images', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('properti_id');
            $table->foreign('properti_id')->references('id')->on('propertis')->onDelete('cascade');
            $table->string('path');
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('property_images');
    }
}
