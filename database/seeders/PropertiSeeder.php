<?php

namespace Database\Seeders;

use App\Models\Properti;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\MasterWilayah;
use Carbon\Carbon;

class PropertiSeeder extends Seeder
{

    public function run(): void
    {
        $faker = fake('id_ID');

        $kodeKelurahanList = DB::table('master_wilayahs')
            ->whereRaw('LENGTH(REPLACE(kode, ".", "")) = 10')
            ->pluck('kode')
            ->toArray();

        if (empty($kodeKelurahanList)) {
            $this->command->warn('Data kelurahan tidak ditemukan di master_wilayahs.');
            return;
        }

        $jenisPropertiIds = DB::table('jenis_propertis')->pluck('id')->toArray();
        $agenIds = DB::table('agens')->pluck('id')->toArray();

        if (empty($jenisPropertiIds)) {
            $this->command->warn('Tabel jenis_propertis kosong. Harap isi dulu sebelum menjalankan PropertiSeeder.');
            return;
        }

        if (empty($agenIds)) {
            $this->command->warn('Tabel agens kosong. Harap isi dulu sebelum menjalankan PropertiSeeder.');
            return;
        }

        // Ambil 4 kode kelurahan acak untuk disisipkan ke properti statis
        $selectedCodes = $faker->randomElements($kodeKelurahanList, 4);

        $wilayahData = collect($selectedCodes)->map(function ($kode) {
            $kodeTanpaTitik = str_replace('.', '', $kode);
            return [
                'kode_kel' => $kode,
                'provinsi' => MasterWilayah::getNamaByKode(substr($kodeTanpaTitik, 0, 2)),
                'kabupaten' => MasterWilayah::getNamaByKode(substr($kodeTanpaTitik, 0, 4)),
                'kecamatan' => MasterWilayah::getNamaByKode(substr($kodeTanpaTitik, 0, 6)),
                'kelurahan' => MasterWilayah::getNamaByKode(substr($kodeTanpaTitik, 0, 10)),
            ];
        })->values();

        $staticPropertis = [
            [
                'judul' => 'Cluster Anthura Tallasa City Makassar',
                'slug' => 'cluster-anthura-tallasa-city-makassar',
                'deskripsi' => '<p>Cluster Anthura hadir dengan desain arsitektur modern yang berpadu pada elemen alam yang dirancang untukmengutamakan kenyamanan dan fungsionalitas.</p><p>Memiliki pilihan tipe unit 6x12, 6x15, 7x15 dan 8x15.</p>',
                'harga' => 1300000000,
                'status' => 'Tersedia',
                'penawaran' => 'Dijual',
                'jenis_cluster' => 'Anthura',
                'tipe_perumahan' => '6x12',
                'kode_pos' => 90241,
                'gbr_primary_properti' => '',
                'alamat_lengkap' => 'Jl. Jalur Lingkaran Barat',
                'jumlah_kamar_tidur' => 3,
                'jumlah_kamar_mandi' => 2,
                'luas_bangunan' => 89,
                'luas_tanah' => 72,
                'tahun_dibangun' => 2025,
                'unggulan' => true,
            ],
            [
                'judul' => 'Dijual Rumah di Summarecon - Blue Crystal',
                'slug' => 'dijual-rumah-di-summarecon-blue-crystal',
                'deskripsi' => '<p>Hunian Modern 2 Lantai di Summarecon Mutiara Makassar</p>',
                'harga' => 1400000000,
                'status' => 'Tersedia',
                'penawaran' => 'Dijual',
                'jenis_cluster' => 'A-12',
                'tipe_perumahan' => 'B36',
                'kode_pos' => 98316,
                'gbr_primary_properti' => '',
                'alamat_lengkap' => 'Jl. Mutiara Boulevard',
                'jumlah_kamar_tidur' => 2,
                'jumlah_kamar_mandi' => 2,
                'luas_bangunan' => 76,
                'luas_tanah' => 112,
                'tahun_dibangun' => 2023,
                'unggulan' => false,
            ],
            [
                'judul' => 'Disewakan Rumah di Summarecon - Blue Crystal',
                'slug' => 'disewakan-rumah-di-summarecon-blue-crystal',
                'deskripsi' => '<p>Hunian Modern 2 Lantai di Summarecon Mutiara Makassar</p>',
                'harga' => 60000000,
                'status' => 'Tersedia',
                'penawaran' => 'Disewa',
                'jenis_cluster' => 'A-12',
                'tipe_perumahan' => 'B36',
                'kode_pos' => 98316,
                'gbr_primary_properti' => '',
                'alamat_lengkap' => 'Jl. Mutiara Boulevard',
                'jumlah_kamar_tidur' => 2,
                'jumlah_kamar_mandi' => 2,
                'luas_bangunan' => 76,
                'luas_tanah' => 112,
                'tahun_dibangun' => 2023,
                'unggulan' => false,
            ],
            [
                'judul' => 'Rumah SmartHome Blue Crystal Summarecon Mutiara Makassar',
                'slug' => 'rumah-smarthome-blue-crystal-summarecon-mutiara-makassar',
                'deskripsi' => '<p>Menggabungkan konsep Rumah Taman dengan smart home technology, Blue Crystal Residence dilengkapi fitur-fitur seperti door window sensor sebagai indikator buka tutup pintu utama, IP Camera yang berfungsi sebagai CCTV di area ruang tamu, smart wall socket yang bisa mengatur nyala lampu dan TV diruang tamu. Kesemuanya akan terintegrasi dalam aplikasi yang terhubung langsung dengan IR gateaway. Selain itu juga dilengkapi fasilitas Club House dengan kolam renang, lapangan basket dan taman bermain anak.</p>',
                'harga' => 1400000000,
                'status' => 'Tersedia',
                'penawaran' => 'Dijual',
                'jenis_cluster' => 'A-12',
                'tipe_perumahan' => 'B36',
                'kode_pos' => 98316,
                'gbr_primary_properti' => '',
                'alamat_lengkap' => 'Jl. Mutiara Boulevard',
                'jumlah_kamar_tidur' => 3,
                'jumlah_kamar_mandi' => 2,
                'luas_bangunan' => 92,
                'luas_tanah' => 84,
                'tahun_dibangun' => 2022,
                'unggulan' => false,
            ],
        ];

        foreach ($staticPropertis as $i => $data) {
            $wilayah = $wilayahData[$i];

            $properti = Properti::create([
                'id' => Str::uuid(),
                'judul' => $data['judul'],
                'slug' => $data['slug'],
                'jenis_properti_id' => $faker->randomElement($jenisPropertiIds),
                'deskripsi' => $data['deskripsi'],
                'harga' => $data['harga'],
                'status' => $data['status'],
                'penawaran' => $data['penawaran'],
                'jenis_cluster' => $data['jenis_cluster'],
                'tipe_perumahan' => $data['tipe_perumahan'],
                'provinsi' => $wilayah['provinsi'],
                'kabupaten' => $wilayah['kabupaten'],
                'kecamatan' => $wilayah['kecamatan'],
                'kelurahan' => $wilayah['kelurahan'],
                'kode_pos' => $data['kode_pos'],
                'link_brosur' => '-',
                'link_layout' => '-',
                'link_spesifikasi' => '-',
                'link_site_plan' => '-',
                'gbr_primary_properti' => $data['gbr_primary_properti'],
                'alamat_lengkap' => $data['alamat_lengkap'],
                'jumlah_kamar_tidur' => $data['jumlah_kamar_tidur'],
                'jumlah_kamar_mandi' => $data['jumlah_kamar_mandi'],
                'luas_bangunan' => $data['luas_bangunan'],
                'luas_tanah' => $data['luas_tanah'],
                'tahun_dibangun' => $data['tahun_dibangun'],
                'unggulan' => $data['unggulan'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Tambahkan relasi ke agens (many-to-many)
            $randomAgens = $faker->randomElements($agenIds, rand(1, 2)); // 1-2 agen per properti
            $properti->agens()->attach($randomAgens);
        }
    }
}
