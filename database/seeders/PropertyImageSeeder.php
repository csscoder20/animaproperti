<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertyImageSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('property_images')->delete();

        // Helper to zero-pad ID to UUID format (simplified for seeding)
        // e.g. 1 -> 00000000-0000-0000-0000-000000000001
        $toUuid = fn($id) => sprintf('00000000-0000-0000-0000-%012d', $id);

        DB::table('property_images')->insert([
            ['id' => $toUuid(1), 'properti_id' => '0198a628-2a21-71be-9b4f-8e6968d69c2f', 'path' => 'https://placehold.co/600x400?text=Executive+Room', 'is_primary' => 1, 'created_at' => '2025-08-05 14:38:29', 'updated_at' => '2025-08-05 14:38:29'],
            ['id' => $toUuid(2), 'properti_id' => '0198e90b-4217-713c-b42a-6a7a6124315c', 'path' => 'https://placehold.co/600x400?text=Executive+Room', 'is_primary' => 1, 'created_at' => '2025-08-06 14:14:14', 'updated_at' => '2025-08-06 14:14:14'],
            ['id' => $toUuid(3), 'properti_id' => '0198e90b-4217-713c-b42a-6a7a6124315c', 'path' => 'https://placehold.co/600x400?text=Executive+Room', 'is_primary' => 0, 'created_at' => '2025-08-06 14:14:14', 'updated_at' => '2025-08-06 14:14:14'],
            ['id' => $toUuid(4), 'properti_id' => '0198e90b-4217-713c-b42a-6a7a6124315c', 'path' => 'https://placehold.co/600x400?text=Executive+Room', 'is_primary' => 0, 'created_at' => '2025-08-06 14:14:14', 'updated_at' => '2025-08-06 14:14:14'],
            ['id' => $toUuid(5), 'properti_id' => '0198e90b-4217-713c-b42a-6a7a6124315c', 'path' => 'https://placehold.co/600x400?text=Executive+Room', 'is_primary' => 0, 'created_at' => '2025-08-06 14:14:14', 'updated_at' => '2025-08-06 14:14:14'],
            ['id' => $toUuid(6), 'properti_id' => '0198e90b-4217-713c-b42a-6a7a6124315c', 'path' => 'https://placehold.co/600x400?text=Executive+Room', 'is_primary' => 0, 'created_at' => '2025-08-06 14:14:14', 'updated_at' => '2025-08-06 14:14:14'],
            ['id' => $toUuid(7), 'properti_id' => '0198e90b-4217-713c-b42a-6a7a6124315c', 'path' => 'https://placehold.co/600x400?text=Executive+Room', 'is_primary' => 0, 'created_at' => '2025-08-06 14:14:14', 'updated_at' => '2025-08-06 14:14:14'],
            ['id' => $toUuid(8), 'properti_id' => '0198e90b-4217-713c-b42a-6a7a6124315c', 'path' => 'https://placehold.co/600x400?text=Executive+Room', 'is_primary' => 0, 'created_at' => '2025-08-06 14:14:14', 'updated_at' => '2025-08-06 14:14:14'],

        ]);
    }
}
