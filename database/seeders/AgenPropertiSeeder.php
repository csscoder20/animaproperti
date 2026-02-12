<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgenPropertiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('agen_properti')->delete();

        DB::table('agen_properti')->insert([
            ['agen_id' => '78c2af7e-e11b-487f-af37-053b0c9676d9', 'properti_id' => '0198a628-2a21-71be-9b4f-8e6968d69c2f', 'created_at' => null, 'updated_at' => null],
            ['agen_id' => '78c2af7e-e11b-487f-af37-053b0c9676d9', 'properti_id' => '0198e90b-4217-713c-b42a-6a7a6124315c', 'created_at' => null, 'updated_at' => null],
            ['agen_id' => '78c2af7e-e11b-487f-af37-053b0c9676d9', 'properti_id' => '0198e92a-db3c-72dc-843d-bd140094d907', 'created_at' => null, 'updated_at' => null],
            ['agen_id' => '78c2af7e-e11b-487f-af37-053b0c9676d9', 'properti_id' => '0198e942-44a8-73a3-9d91-94559bc33471', 'created_at' => null, 'updated_at' => null],
            ['agen_id' => '78c2af7e-e11b-487f-af37-053b0c9676d9', 'properti_id' => '0198e94f-6c54-7257-a342-9d3c26aac202', 'created_at' => null, 'updated_at' => null],
            ['agen_id' => '78c2af7e-e11b-487f-af37-053b0c9676d9', 'properti_id' => '0198e962-51e0-70a7-84cc-15cd3591baf4', 'created_at' => null, 'updated_at' => null],
            ['agen_id' => '78c2af7e-e11b-487f-af37-053b0c9676d9', 'properti_id' => '0198eae4-bd2e-733d-beb3-d749677c0d63', 'created_at' => null, 'updated_at' => null],
            ['agen_id' => '78c2af7e-e11b-487f-af37-053b0c9676d9', 'properti_id' => '019994b1-8b10-7212-8e61-9ca5f8004332', 'created_at' => null, 'updated_at' => null],
            ['agen_id' => '78c2af7e-e11b-487f-af37-053b0c9676d9', 'properti_id' => '6bf51334-707c-412e-ba8d-00fdcd39ce79', 'created_at' => null, 'updated_at' => null],
            ['agen_id' => '78c2af7e-e11b-487f-af37-053b0c9676d9', 'properti_id' => 'a2a77ce3-79d4-4023-a025-b76a534f39c0', 'created_at' => null, 'updated_at' => null],
            ['agen_id' => '78c2af7e-e11b-487f-af37-053b0c9676d9', 'properti_id' => 'f4808f9f-acf6-4288-b4a1-605b9511bb0f', 'created_at' => null, 'updated_at' => null],
        ]);
    }
}
