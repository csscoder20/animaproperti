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
        DB::table('jenis_propertis')->delete();

        $data = [
            ['id' => '0f94d970-e2ce-4521-9a93-7e1e29e73794', 'nama' => 'Cluster', 'slug' => 'cluster', 'deskripsi' => 'Jenis properti berupa Cluster.', 'created_at' => '2025-08-05 13:28:29', 'updated_at' => '2025-08-05 13:28:29'],
            ['id' => '58483588-f31d-4b6d-ae7f-8558720ebb4d', 'nama' => 'Villa', 'slug' => 'villa', 'deskripsi' => 'Jenis properti berupa Villa.', 'created_at' => '2025-08-05 13:28:29', 'updated_at' => '2025-08-05 13:28:29'],
            ['id' => '8f7087f7-c5ce-4a85-9371-c37ad8784966', 'nama' => 'Ruko', 'slug' => 'ruko', 'deskripsi' => 'Jenis properti berupa Ruko.', 'created_at' => '2025-08-05 13:28:29', 'updated_at' => '2025-08-05 13:28:29'],
            ['id' => '8fc20101-1fb6-47ab-ab92-1c2e7fca7d42', 'nama' => 'Kantor', 'slug' => 'kantor', 'deskripsi' => 'Jenis properti berupa Kantor.', 'created_at' => '2025-08-05 13:28:29', 'updated_at' => '2025-08-05 13:28:29'],
            ['id' => 'a3d7f0b3-707a-4d4c-bc3a-887ed9443823', 'nama' => 'Gudang', 'slug' => 'gudang', 'deskripsi' => 'Jenis properti berupa Gudang.', 'created_at' => '2025-08-05 13:28:29', 'updated_at' => '2025-08-05 13:28:29'],
            ['id' => 'a6023ab6-4e6e-4add-b2aa-9ef2e39e2bfa', 'nama' => 'Rumah', 'slug' => 'rumah', 'deskripsi' => 'Jenis properti berupa Rumah.', 'created_at' => '2025-08-05 13:28:29', 'updated_at' => '2025-08-05 13:28:29'],
            ['id' => 'b64ace4f-fcab-4a1f-a7a7-44632b50d3c1', 'nama' => 'Perumahan', 'slug' => 'perumahan', 'deskripsi' => 'Jenis properti berupa Perumahan.', 'created_at' => '2025-08-05 13:28:29', 'updated_at' => '2025-08-05 13:28:29'],
            ['id' => 'c3d05c3e-a3d2-48f2-b5b6-006a6d43d3c5', 'nama' => 'Apartemen', 'slug' => 'apartemen', 'deskripsi' => 'Jenis properti berupa Apartemen.', 'created_at' => '2025-08-05 13:28:29', 'updated_at' => '2025-08-05 13:28:29'],
            ['id' => 'e16734bc-b47b-4bf0-b5a8-08f2f273bf11', 'nama' => 'Tanah', 'slug' => 'tanah', 'deskripsi' => 'Jenis properti berupa Tanah.', 'created_at' => '2025-08-05 13:28:29', 'updated_at' => '2025-08-05 13:28:29'],
            ['id' => 'ef178b65-0ccb-4a26-a5d2-584f8ccf2523', 'nama' => 'Kost', 'slug' => 'kost', 'deskripsi' => 'Jenis properti berupa Kost.', 'created_at' => '2025-08-05 13:28:29', 'updated_at' => '2025-08-05 13:28:29'],
        ];

        DB::table('jenis_propertis')->insert($data);
    }
}
