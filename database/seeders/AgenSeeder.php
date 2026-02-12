<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class AgenSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        DB::table('agens')->delete();

        DB::table('agens')->insert([
            'id' => '78c2af7e-e11b-487f-af37-053b0c9676d9',
            'nama_lengkap' => 'Anita Maya Kesuma',
            'gender' => 'Perempuan',
            'birth_city' => 'Solok',
            'birth_date' => '1999-07-07',
            'no_hp' => '+628114617733',
            'email' => 'nita@wicom.co.id',
            'social_media' => 'instagram',
            'social_media_id' => 'anima.properti',
            'kode_pos' => '35073',
            'alamat_lengkap' => 'makassar',
            'pendidikan' => 'D3',
            'nama_sekolah' => 'CV Prastuti Purwanti University',
            'tahun_lulus' => '1991',
            'nilai_ipk' => 2.66,
            'sertifikat_kompetensi' => null,
            'nama_perusahaan' => 'PD Kuswandari Mulyani',
            'tahun_masuk' => '1986',
            'tahun_keluar' => '2020',
            'alasan_keluar' => 'Aut et nostrum totam.',
            'pas_foto' => 'data-agen/01K246A20JRJB05GTA62672V45.png',
            'ktp' => null,
            'cv' => null,
            'kartu_nama' => null,
            'perjanjian' => 1,
            'status' => 'Approved',
            'created_at' => '2025-08-05 13:28:29',
            'updated_at' => '2025-08-08 06:36:19',
        ]);
    }
}
