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
            ['id' => $toUuid(1), 'properti_id' => '0198a628-2a21-71be-9b4f-8e6968d69c2f', 'path' => 'data-properti/01K24M4TXY710E1853N5T3PZ4Q.jpg', 'is_primary' => 1, 'created_at' => '2025-08-05 14:38:29', 'updated_at' => '2025-08-05 14:38:29'],
            ['id' => $toUuid(2), 'properti_id' => '0198e90b-4217-713c-b42a-6a7a6124315c', 'path' => 'data-properti/01K27E1J9FW5756C514X9T3A97.jpg', 'is_primary' => 1, 'created_at' => '2025-08-06 14:14:14', 'updated_at' => '2025-08-06 14:14:14'],
            ['id' => $toUuid(3), 'properti_id' => '0198e90b-4217-713c-b42a-6a7a6124315c', 'path' => 'data-properti/01K27E1J9J283592F017X8F55S.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:14:14', 'updated_at' => '2025-08-06 14:14:14'],
            ['id' => $toUuid(4), 'properti_id' => '0198e90b-4217-713c-b42a-6a7a6124315c', 'path' => 'data-properti/01K27E1J9K2CZE3480B7V08S8T.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:14:14', 'updated_at' => '2025-08-06 14:14:14'],
            ['id' => $toUuid(5), 'properti_id' => '0198e90b-4217-713c-b42a-6a7a6124315c', 'path' => 'data-properti/01K27E1J9N961E62Y46W854E1Y.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:14:14', 'updated_at' => '2025-08-06 14:14:14'],
            ['id' => $toUuid(6), 'properti_id' => '0198e90b-4217-713c-b42a-6a7a6124315c', 'path' => 'data-properti/01K27E1J9PH8G93892015HCA6Z.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:14:14', 'updated_at' => '2025-08-06 14:14:14'],
            ['id' => $toUuid(7), 'properti_id' => '0198e90b-4217-713c-b42a-6a7a6124315c', 'path' => 'data-properti/01K27E1J9R15E06041D3H794XQ.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:14:14', 'updated_at' => '2025-08-06 14:14:14'],
            ['id' => $toUuid(8), 'properti_id' => '0198e90b-4217-713c-b42a-6a7a6124315c', 'path' => 'data-properti/01K27E1J9ST5N742111X585Q8T.jpg', 'is_primary' => 0, 'created_at' => '2025-08-06 14:14:14', 'updated_at' => '2025-08-06 14:14:14'],

        ]);
    }
}
