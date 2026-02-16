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
        \Illuminate\Support\Facades\DB::table('fasilitas')->delete();

        $fasilitas = [
            ['id' => \Illuminate\Support\Str::uuid(), 'nama' => 'AC', 'icon' => 'bi-snow'],
            ['id' => \Illuminate\Support\Str::uuid(), 'nama' => 'Wifi', 'icon' => 'bi-wifi'],
            ['id' => \Illuminate\Support\Str::uuid(), 'nama' => 'TV', 'icon' => 'bi-tv'],
            ['id' => \Illuminate\Support\Str::uuid(), 'nama' => 'Dapur', 'icon' => 'bi-cup-hot'],
            ['id' => \Illuminate\Support\Str::uuid(), 'nama' => 'Parkir', 'icon' => 'bi-car-front'],
            ['id' => \Illuminate\Support\Str::uuid(), 'nama' => 'Kolam Renang', 'icon' => 'bi-water'],
            ['id' => \Illuminate\Support\Str::uuid(), 'nama' => 'Kamar Mandi Dalam', 'icon' => 'bi-droplet'],
            ['id' => \Illuminate\Support\Str::uuid(), 'nama' => 'Pemanas Air', 'icon' => 'bi-thermometer-half'],
            ['id' => \Illuminate\Support\Str::uuid(), 'nama' => 'Gym', 'icon' => 'bi-activity'],
            ['id' => \Illuminate\Support\Str::uuid(), 'nama' => 'Keamanan 24 Jam', 'icon' => 'bi-shield-check'],
            ['id' => \Illuminate\Support\Str::uuid(), 'nama' => 'Laundry', 'icon' => 'bi-basket'],
            ['id' => \Illuminate\Support\Str::uuid(), 'nama' => 'Rooftop', 'icon' => 'bi-building-up'],
            ['id' => \Illuminate\Support\Str::uuid(), 'nama' => 'Lift', 'icon' => 'bi-arrow-up-down'],
            ['id' => \Illuminate\Support\Str::uuid(), 'nama' => 'CCTV', 'icon' => 'bi-camera-video'],
        ];

        foreach ($fasilitas as $f) {
            \App\Models\Fasilitas::create($f);
        }
    }
}
