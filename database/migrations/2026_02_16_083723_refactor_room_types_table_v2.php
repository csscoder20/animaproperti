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
        Schema::table('tipe_kamars', function (Blueprint $table) {
            $table->decimal('harga_per_malam', 15, 2)->default(0)->after('nama');
            $table->integer('jumlah_kamar')->default(1)->after('harga_per_malam');
            $table->integer('kapasitas_dewasa')->default(1)->after('jumlah_kamar');
            $table->integer('kapasitas_anak')->default(0)->after('kapasitas_dewasa');
            $table->date('tersedia_dari')->nullable()->after('kapasitas_anak');
            $table->date('tersedia_sampai')->nullable()->after('tersedia_dari');
            $table->string('luas_kamar')->nullable()->after('tersedia_sampai');
            $table->string('tipe_bed')->nullable()->after('luas_kamar');
            $table->string('gambar')->nullable()->after('tipe_bed');
        });

        Schema::create('fasilitas_tipe_kamar', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('tipe_kamar_id')->constrained('tipe_kamars')->cascadeOnDelete();
            $table->foreignUuid('fasilitas_id')->constrained('fasilitas')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasilitas_tipe_kamar');
        Schema::table('tipe_kamars', function (Blueprint $table) {
            $table->dropColumn([
                'harga_per_malam',
                'jumlah_kamar',
                'kapasitas_dewasa',
                'kapasitas_anak',
                'tersedia_dari',
                'tersedia_sampai',
                'luas_kamar',
                'tipe_bed',
                'gambar'
            ]);
        });
    }
};
