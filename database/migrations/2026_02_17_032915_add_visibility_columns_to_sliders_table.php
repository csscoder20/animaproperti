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
        Schema::table('sliders', function (Blueprint $table) {
            $table->boolean('is_temporary')->default(false)->after('is_active');
            $table->boolean('show_on_home')->default(true)->after('is_temporary');
            $table->boolean('show_on_sewa')->default(false)->after('show_on_home');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->dropColumn(['is_temporary', 'show_on_home', 'show_on_sewa']);
        });
    }
};
