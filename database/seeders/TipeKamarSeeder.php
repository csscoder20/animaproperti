<?php

namespace Database\Seeders;

use App\Models\TipeKamar;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class TipeKamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear tables to prevent duplicates and ensure fresh data
        // Disable foreign key checks to allow truncation/deletion
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('fasilitas_tipe_kamar')->truncate();
        DB::table('properti_tipe_kamar')->truncate();
        DB::table('tipe_kamars')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $tipeKamars = [
            [
                'nama' => 'Presidential Suite',
                'harga_per_malam' => 2500000,
                'jumlah_kamar' => 1,
                'kapasitas_dewasa' => 4,
                'kapasitas_anak' => 2,
                'luas_kamar' => '60 m²',
                'tipe_bed' => 'King Bed',
                'gambar' => 'https://placehold.co/600x400?text=Presidential+Suite',
            ],
            [
                'nama' => 'Family Room',
                'harga_per_malam' => 1500000,
                'jumlah_kamar' => 1,
                'kapasitas_dewasa' => 3,
                'kapasitas_anak' => 2,
                'luas_kamar' => '45 m²',
                'tipe_bed' => '2 Queen Beds',
                'gambar' => 'https://placehold.co/600x400?text=Family+Room',
            ],
             [
                'nama' => 'Executive Room',
                'harga_per_malam' => 1200000,
                'jumlah_kamar' => 1,
                'kapasitas_dewasa' => 2,
                'kapasitas_anak' => 1,
                'luas_kamar' => '35 m²',
                'tipe_bed' => 'King Bed',
                'gambar' => 'https://placehold.co/600x400?text=Executive+Room',
            ],
        ];

        foreach ($tipeKamars as $data) {
            $tipe = TipeKamar::create([
                'id' => Str::uuid(),
                'tersedia_dari' => now(),
                'tersedia_sampai' => now()->addYear(),
                ...$data
            ]);
            
            // Attach random generic facilities if they exist permissions? No, FasilitasSeeder runs before this.
             $roomFasilitas = \App\Models\Fasilitas::inRandomOrder()->take(3)->pluck('id');
             $tipe->fasilitas()->attach($roomFasilitas);
        }
    }
}
