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
        Schema::create('penyewaans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('properti_id')->constrained('propertis')->onDelete('cascade');
            $table->foreignUuid('pelanggan_id')->constrained('pelanggans')->onDelete('cascade');
            $table->string('nama_penyewaan')->nullable();
            $table->string('lama_sewa');
            $table->decimal('harga_total', 15, 2);
            $table->decimal('pembayaran', 15, 2);
            $table->string('status_pembayaran'); // Lunas, DP
            $table->decimal('nilai_dp', 15, 2)->nullable();
            $table->date('tanggal_transaksi');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyewaans');
    }
};
