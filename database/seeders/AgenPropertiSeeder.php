<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AgenPropertiSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama
        DB::table('agen_properti')->delete();

        // ID agen yang valid (pastikan agen ini ada di database)
        $agenId = '78c2af7e-e11b-487f-af37-053b0c9676d9';

        // CEK: Apakah agen dengan ID ini ada?
        $agenExists = DB::table('agens')->where('id', $agenId)->exists();
        
        if (!$agenExists) {
            $this->command->error('Agen with ID ' . $agenId . ' not found! Please check AgenSeeder.');
            return;
        }

        // Ambil SEMUA ID properti yang ADA dari database
        $existingPropertiIds = DB::table('propertis')->pluck('id')->toArray();

        if (empty($existingPropertiIds)) {
            $this->command->error('No properties found in database! Please run PropertiSeeder first.');
            return;
        }

        $this->command->info('Found ' . count($existingPropertiIds) . ' properties in database:');
        foreach ($existingPropertiIds as $id) {
            $this->command->info(' - ' . $id);
        }

        $data = [];
        $now = Carbon::now();

        foreach ($existingPropertiIds as $propertiId) {
            $data[] = [
                'agen_id' => $agenId,
                'properti_id' => $propertiId,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        // Insert data
        DB::table('agen_properti')->insert($data);
        
        $this->command->info('Successfully seeded ' . count($data) . ' agen_properti records!');
    }
}