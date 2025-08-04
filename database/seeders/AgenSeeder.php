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

        foreach (range(1, 5) as $i) {
            $gender = $faker->randomElement(['Laki-laki', 'Perempuan']);
            $firstName = $faker->firstName($gender === 'Laki-laki' ? 'male' : 'female');
            $lastName = $faker->lastName;
            $namalengkap = $firstName . ' ' . $lastName;

            DB::table('agens')->insert([
                'id' => Str::uuid(),
                'nama_lengkap' => $namalengkap,
                'gender' => $gender,
                'birth_city' => $faker->city,
                'birth_date' => $faker->date('Y-m-d', '-20 years'),
                'no_hp' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'social_media' => 'Instagram',
                'social_media_id' => '@' . Str::slug($namalengkap),
                'kode_pos' => $faker->postcode,
                'alamat_lengkap' => $faker->address,
                'pendidikan' => $faker->randomElement(['SMA', 'D3', 'S1', 'S2']),
                'nama_sekolah' => $faker->company . ' University',
                'tahun_lulus' => $faker->year('-2 years'),
                'nilai_ipk' => $faker->randomFloat(2, 2.00, 4.00),
                'nama_perusahaan' => $faker->company,
                'tahun_masuk' => $faker->year('-5 years'),
                'tahun_keluar' => $faker->year('-1 years'),
                'alasan_keluar' => $faker->sentence,
                'status' => 'Pending',
                'pas_foto' => '',
                'kartu_nama' => '',
                'ktp' => '',
                'cv' => '',
                'sertifikat_kompetensi' => '',
                'perjanjian' => $faker->boolean(80),

                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
