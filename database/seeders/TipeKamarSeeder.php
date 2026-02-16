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
