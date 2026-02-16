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
        $table = 'properti_tipe_kamar';

        // 1. Try to drop Foreign Keys
        try {
            Schema::table($table, function (Blueprint $t) {
                $t->dropForeign(['properti_id']);
            });
        } catch (\Throwable $e) {}

        try {
            Schema::table($table, function (Blueprint $t) {
                $t->dropForeign(['tipe_kamar_id']);
            });
        } catch (\Throwable $e) {}

        // 2. Try to drop Primary Key
        try {
            Schema::table($table, function (Blueprint $t) {
                $t->dropPrimary(['properti_id', 'tipe_kamar_id']);
            });
        } catch (\Throwable $e) {
            // Try without array if name mismatch
            try {
                Schema::table($table, function (Blueprint $t) {
                    $t->dropPrimary();
                });
            } catch (\Throwable $e2) {}
        }

        // 3. Add ID if missing
        if (!Schema::hasColumn($table, 'id')) {
            Schema::table($table, function (Blueprint $t) {
                 $t->uuid('id')->primary()->first();
            });
        }

        // 4. Add columns if missing
        Schema::table($table, function (Blueprint $t) use ($table) {
            if (!Schema::hasColumn($table, 'harga_per_malam')) {
                $t->decimal('harga_per_malam', 15, 2)->default(0)->after('tipe_kamar_id');
            }
            if (!Schema::hasColumn($table, 'tersedia_dari')) {
                $t->date('tersedia_dari')->nullable()->after('harga_per_malam');
            }
            if (!Schema::hasColumn($table, 'tersedia_sampai')) {
                $t->date('tersedia_sampai')->nullable()->after('tersedia_dari');
            }
            if (!Schema::hasColumn($table, 'kapasitas_dewasa')) {
                $t->integer('kapasitas_dewasa')->default(1)->after('tersedia_sampai');
            }
            if (!Schema::hasColumn($table, 'kapasitas_anak')) {
                $t->integer('kapasitas_anak')->default(0)->after('kapasitas_dewasa');
            }
            if (!Schema::hasColumn($table, 'jumlah_kamar')) {
                $t->integer('jumlah_kamar')->default(1)->after('kapasitas_anak');
            }
        });

        // 5. Re-add FKs and Unique details
        // We use try-catch to avoid duplications if they persist
        try {
            Schema::table($table, function (Blueprint $t) {
                $t->unique(['properti_id', 'tipe_kamar_id']);
            });
        } catch (\Throwable $e) {}

        try {
            Schema::table($table, function (Blueprint $t) {
                $t->foreign('properti_id')->references('id')->on('propertis')->cascadeOnDelete();
                $t->foreign('tipe_kamar_id')->references('id')->on('tipe_kamars')->cascadeOnDelete();
            });
        } catch (\Throwable $e) {}
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $table = 'properti_tipe_kamar';
        
        // This is tricky because we don't know exact state, but let's try to revert logic
        try {
             Schema::table($table, function (Blueprint $t) {
                $t->dropForeign(['properti_id']);
                $t->dropForeign(['tipe_kamar_id']);
                $t->dropUnique(['properti_id', 'tipe_kamar_id']);
                
                $t->dropColumn([
                    'id',
                    'harga_per_malam',
                    'tersedia_dari',
                    'tersedia_sampai',
                    'kapasitas_dewasa',
                    'kapasitas_anak',
                    'jumlah_kamar'
                ]);
                
                $t->primary(['properti_id', 'tipe_kamar_id']);
                
                $t->foreign('properti_id')->references('id')->on('propertis')->cascadeOnDelete();
                $t->foreign('tipe_kamar_id')->references('id')->on('tipe_kamars')->cascadeOnDelete();
            });
        } catch (\Throwable $e) {}
    }
};
