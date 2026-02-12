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
        Schema::dropIfExists('bookings');
        Schema::create('bookings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('properti_id')->constrained('propertis')->onDelete('cascade');
            $table->foreignUuid('agent_id')->constrained('agens')->onDelete('cascade'); // Assuming 'agens' table exists
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->date('checkin');
            $table->date('checkout');
            $table->integer('rooms');
            $table->integer('guests');
            $table->integer('duration'); // in days/nights
            $table->decimal('total_price', 15, 2);
            $table->string('status')->default('pending'); // pending, confirmed, cancelled
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
