<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class, // Run this early to set up roles
            UserSeeder::class,
            MasterWilayahSeeder::class,
            JenisPropertiSeeder::class,
            AgenSeeder::class,
            PropertiSeeder::class,
            PropertyImageSeeder::class,
            AgenPropertiSeeder::class,
            PelangganSeeder::class, // Needs to run before Penjualan
            PenjualanSeeder::class,
            InformasiSeeder::class,
            PengaturanSeeder::class,
            SliderSeeder::class,
            TestimoniSeeder::class,
            SkPrivasiSeeder::class,
            TentangKamiSeeder::class,
        ]);
    }
}
