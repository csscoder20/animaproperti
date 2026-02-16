<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PenjualanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('penjualans')->delete();

        // Cari ID properti yang valid (ganti dengan ID yang ADA)
        $propertiDijual = DB::table('propertis')
            ->where('penawaran', 'Dijual')
            ->first();

        if (!$propertiDijual) {
            $this->command->error('No properties for sale found!');
            return;
        }

        // Ambil pelanggan yang ADA
        $pelangganIds = DB::table('pelanggans')->pluck('id')->toArray();
        
        if (count($pelangganIds) < 2) {
            $this->command->error('Need at least 2 customers!');
            return;
        }

        $now = Carbon::now();

        // Data penjualan dengan ID properti yang VALID
        $penjualanData = [
            [
                'id' => '01987fde-d916-7359-a023-0d3150d03dbc',
                'properti_id' => $propertiDijual->id, // Gunakan ID yang valid
                'pelanggan_id' => $pelangganIds[0],
                'telepon' => '081255500005',
                'email' => 'andika@example.com',
                'npwp' => '73.004.567.8-901.234',
                'foto_ktp' => null,
                'foto_npwp' => null,
                'alamat' => 'Jl. kapasa raya',
                'kode_pos' => '90241',
                'provinsi' => 'Sulawesi Selatan',
                'kabupaten' => 'Kota Makassar',
                'kecamatan' => 'Tamalanrea',
                'kelurahan' => 'Kapasa',
                'jenis_cluster' => $propertiDijual->jenis_cluster ?? 'Anthura',
                'tipe_perumahan' => $propertiDijual->tipe_perumahan ?? '6x12',
                'jumlah_kamar_tidur' => $propertiDijual->jumlah_kamar_tidur ?? 3,
                'jumlah_kamar_mandi' => $propertiDijual->jumlah_kamar_mandi ?? 2,
                'luas_bangunan' => $propertiDijual->luas_bangunan ?? 89,
                'luas_tanah' => $propertiDijual->luas_tanah ?? 72,
                'tanggal_penjualan' => '2025-08-02',
                'harga' => 1300000000.00,
                'harga_jual' => 1300000000.00,
                'metode_pembayaran' => 'tunai',
                'status_pembayaran' => 'belum_dibayar',
                'catatan' => null,
                'dokumen_pendukung' => null,
                'created_at' => '2025-08-06 14:52:47',
                'updated_at' => '2025-08-06 14:52:47'
            ],
            [
                'id' => '01987fe0-1685-7246-a30f-957e010d99fd',
                'properti_id' => $propertiDijual->id, // Gunakan ID yang sama atau cari properti lain
                'pelanggan_id' => $pelangganIds[1],
                'telepon' => '0215678910',
                'email' => 'info@banguncipta.com',
                'npwp' => '03.333.333.3-333.000',
                'foto_ktp' => null,
                'foto_npwp' => null,
                'alamat' => 'Jl. kapasa raya',
                'kode_pos' => '90241',
                'provinsi' => 'Sulawesi Selatan',
                'kabupaten' => 'Kota Makassar',
                'kecamatan' => 'Tamalanrea',
                'kelurahan' => 'Kapasa',
                'jenis_cluster' => $propertiDijual->jenis_cluster ?? 'Anthura',
                'tipe_perumahan' => $propertiDijual->tipe_perumahan ?? '6x12',
                'jumlah_kamar_tidur' => $propertiDijual->jumlah_kamar_tidur ?? 3,
                'jumlah_kamar_mandi' => $propertiDijual->jumlah_kamar_mandi ?? 2,
                'luas_bangunan' => $propertiDijual->luas_bangunan ?? 89,
                'luas_tanah' => $propertiDijual->luas_tanah ?? 72,
                'tanggal_penjualan' => '2025-08-02',
                'harga' => 1300000000.00,
                'harga_jual' => 1300000000.00,
                'metode_pembayaran' => 'tunai',
                'status_pembayaran' => 'belum_dibayar',
                'catatan' => null,
                'dokumen_pendukung' => null,
                'created_at' => '2025-08-06 14:54:09',
                'updated_at' => '2025-08-06 14:54:09'
            ]
        ];

        DB::table('penjualans')->insert($penjualanData);
        $this->command->info('Successfully seeded ' . count($penjualanData) . ' penjualan records!');
    }
}