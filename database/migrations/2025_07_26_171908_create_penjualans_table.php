<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('properti_id');
            $table->foreign('properti_id')->references('id')->on('propertis')->onDelete('cascade');
            $table->uuid('pelanggan_id');
            $table->foreign('pelanggan_id')->references('id')->on('pelanggans')->onDelete('cascade');
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('npwp')->nullable();
            $table->string('foto_ktp')->nullable();
            $table->string('foto_npwp')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kode_pos', 10)->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('jenis_cluster')->nullable();
            $table->string('tipe_perumahan')->nullable();
            $table->integer('jumlah_kamar_tidur')->nullable();
            $table->integer('jumlah_kamar_mandi')->nullable();
            $table->integer('luas_bangunan')->nullable();
            $table->integer('luas_tanah')->nullable();
            $table->date('tanggal_penjualan');
            $table->decimal('harga', 15, 2)->nullable();
            $table->decimal('harga_jual', 15, 2);
            $table->enum('metode_pembayaran', [
                'tunai',
                'transfer',
                'kredit',
                'cicilan',
                'leasing',
                'e-wallet'
            ]);

            $table->enum('status_pembayaran', [
                'belum_dibayar',
                'dp_dibayar',
                'lunas',
                'cicil',
                'gagal'
            ])->default('belum_dibayar');

            $table->text('catatan')->nullable();
            $table->string('dokumen_pendukung')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
