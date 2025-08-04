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
        Schema::create('agens', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_lengkap');
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->string('birth_city');
            $table->date('birth_date');
            $table->string('no_hp');
            $table->string('email')->unique();
            $table->string('social_media');
            $table->string('social_media_id');
            $table->string('kode_pos')->nullable();
            $table->text('alamat_lengkap')->nullable();
            $table->string('pendidikan');
            $table->string('nama_sekolah');
            $table->year('tahun_lulus');
            $table->decimal('nilai_ipk', 4, 2);
            $table->string('sertifikat_kompetensi')->nullable();
            $table->string('nama_perusahaan');
            $table->year('tahun_masuk');
            $table->year('tahun_keluar');
            $table->text('alasan_keluar');
            $table->string('pas_foto')->nullable();
            $table->string('ktp')->nullable();
            $table->string('cv')->nullable();
            $table->string('kartu_nama')->nullable();
            $table->boolean('perjanjian')->default(false);
            $table->enum('status', ['Pending', 'Approved', 'Rejected']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agens');
    }
};
