<?php

namespace Database\Seeders;

// use App\Models\JenisProperti;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class JenisPropertiSeeder extends Seeder
{
    public function run(): void
    {
        $jenisList = [
            'Rumah',
            'Ruko',
            'Apartemen',
            'Kost',
            'Villa',
            'Tanah',
            'Gudang',
            'Kantor',
            'Perumahan',
            'Cluster',
        ];

        foreach ($jenisList as $nama) {
            DB::table('jenis_propertis')->insert([
                'id' => Str::uuid(),
                'nama' => $nama,
                'slug' => Str::slug($nama),
                'deskripsi' => "Jenis properti berupa {$nama}.",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
