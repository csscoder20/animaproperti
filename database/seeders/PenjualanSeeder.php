<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('penjualans')->delete();

        DB::table('penjualans')->insert([
            ['id' => '01987fde-d916-7359-a023-0d3150d03dbc', 'properti_id' => '6bf51334-707c-412e-ba8d-00fdcd39ce79', 'pelanggan_id' => 'e002bd7e-72bf-45c9-b0d4-4ba41febb274', 'telepon' => '081255500005', 'email' => 'andika@example.com', 'npwp' => '73.004.567.8-901.234', 'foto_ktp' => NULL, 'foto_npwp' => NULL, 'alamat' => 'Jl. kapasa raya', 'kode_pos' => '90241', 'provinsi' => 'Sulawesi Selatan', 'kabupaten' => 'Kota Makassar', 'kecamatan' => 'Tamalanrea', 'kelurahan' => 'Kapasa', 'jenis_cluster' => 'Anthura', 'tipe_perumahan' => '6x12', 'jumlah_kamar_tidur' => 3, 'jumlah_kamar_mandi' => 2, 'luas_bangunan' => 89, 'luas_tanah' => 72, 'tanggal_penjualan' => '2025-08-02', 'harga' => 1300000000.00, 'harga_jual' => 1300000000.00, 'metode_pembayaran' => 'tunai', 'status_pembayaran' => 'belum_dibayar', 'catatan' => NULL, 'dokumen_pendukung' => NULL, 'created_at' => '2025-08-06 14:52:47', 'updated_at' => '2025-08-06 14:52:47'],
            ['id' => '01987fe0-1685-7246-a30f-957e010d99fd', 'properti_id' => '6bf51334-707c-412e-ba8d-00fdcd39ce79', 'pelanggan_id' => '99ac7f0a-b116-4c31-9407-038fdb3e7591', 'telepon' => '0215678910', 'email' => 'info@banguncipta.com', 'npwp' => '03.333.333.3-333.000', 'foto_ktp' => NULL, 'foto_npwp' => NULL, 'alamat' => 'Jl. kapasa raya', 'kode_pos' => '90241', 'provinsi' => 'Sulawesi Selatan', 'kabupaten' => 'Kota Makassar', 'kecamatan' => 'Tamalanrea', 'kelurahan' => 'Kapasa', 'jenis_cluster' => 'Anthura', 'tipe_perumahan' => '6x12', 'jumlah_kamar_tidur' => 3, 'jumlah_kamar_mandi' => 2, 'luas_bangunan' => 89, 'luas_tanah' => 72, 'tanggal_penjualan' => '2025-08-02', 'harga' => 1300000000.00, 'harga_jual' => 1300000000.00, 'metode_pembayaran' => 'tunai', 'status_pembayaran' => 'belum_dibayar', 'catatan' => NULL, 'dokumen_pendukung' => NULL, 'created_at' => '2025-08-06 14:54:09', 'updated_at' => '2025-08-06 14:54:09']
        ]);
    }
}
