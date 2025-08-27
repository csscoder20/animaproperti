<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertisTable extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propertis', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->uuid('jenis_properti_id');
            $table->foreign('jenis_properti_id')->references('id')->on('jenis_propertis')->onDelete('cascade');
            $table->text('deskripsi');
            $table->decimal('harga', 15, 2);
            $table->enum('status', ['Tersedia', 'Terjual', 'Tersewa', 'Tidak Aktif']);
            $table->enum('penawaran', ['Dijual', 'Disewa']);
            $table->string('jenis_cluster')->nullable();
            $table->string('tipe_perumahan')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();
            $table->integer('kode_pos')->nullable();
            $table->string('link_brosur')->nullable();
            $table->string('link_layout')->nullable();
            $table->string('link_spesifikasi')->nullable();
            $table->string('link_site_plan')->nullable();
            $table->string('gbr_primary_properti')->nullable();
            $table->string('alamat_lengkap')->nullable();
            $table->integer('jumlah_kamar_tidur')->nullable();
            $table->integer('jumlah_kamar_mandi')->nullable();
            $table->integer('luas_bangunan')->nullable();
            $table->integer('luas_tanah')->nullable();
            $table->integer('tahun_dibangun')->nullable();
            $table->boolean('unggulan')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Batalkan migrasi.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('propertis');
    }
}
