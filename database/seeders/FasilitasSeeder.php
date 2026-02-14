<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fasilitas = [
            ['nama' => 'AC', 'icon' => 'bi-snow'],
            ['nama' => 'Wifi', 'icon' => 'bi-wifi'],
            ['nama' => 'TV', 'icon' => 'bi-tv'],
            ['nama' => 'Dapur', 'icon' => 'bi-cup-hot'],
            ['nama' => 'Parkir', 'icon' => 'bi-car-front'],
            ['nama' => 'Kolam Renang', 'icon' => 'bi-water'],
            ['nama' => 'Kamar Mandi Dalam', 'icon' => 'bi-droplet'],
            ['nama' => 'Pemanas Air', 'icon' => 'bi-thermometer-half'],
        ];

        foreach ($fasilitas as $f) {
            \App\Models\Fasilitas::create($f);
        }
    }
}
