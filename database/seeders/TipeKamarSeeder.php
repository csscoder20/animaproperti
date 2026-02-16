<?php

namespace Database\Seeders;

use App\Models\TipeKamar;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TipeKamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Illuminate\Support\Facades\DB::table('properti_tipe_kamar')->delete();
        \Illuminate\Support\Facades\DB::table('tipe_kamars')->delete();

        $tipeKamars = [
            'Standard Room',
            'Superior Room',
            'Deluxe Room',
            'Junior Suite',
            'Suite Room',
            'Presidential Suite',
            'Family Room',
            'Single Room',
            'Twin Room',
            'Double Room',
            'Studio Room',
            'Executive Room',
        ];

        foreach ($tipeKamars as $nama) {
            TipeKamar::create([
                'id' => Str::uuid(),
                'nama' => $nama,
            ]);
        }
    }
}
