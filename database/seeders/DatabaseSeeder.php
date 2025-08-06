<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            MasterWilayahSeeder::class,
            JenisPropertiSeeder::class,
            AgenSeeder::class,
            PropertiSeeder::class,
            PelangganSeeder::class,
            InformasiSeeder::class,
        ]);
    }
}
