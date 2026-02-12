<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sliders')->delete();

        DB::table('sliders')->insert([
            ['id' => '01988d54-0d99-7381-8c78-3ee9099e8340', 'title' => 'Slider 1', 'subtitle' => NULL, 'image_path' => 'data-informasi/01K26N83CNZEV39XPYA4AY7NT6.png', 'link_url' => NULL, 'order' => 1, 'is_active' => 1, 'start_date' => '2025-08-14 00:00:00', 'end_date' => '2025-12-31 00:00:00', 'created_at' => '2025-08-09 05:35:52', 'updated_at' => '2025-09-02 09:58:36'],
            ['id' => '01988d54-8977-7255-9461-bd4136d8fa59', 'title' => 'Slider 2', 'subtitle' => NULL, 'image_path' => 'data-informasi/01K26N92BK5H7M5D01GWTK5GGM.png', 'link_url' => NULL, 'order' => 2, 'is_active' => 1, 'start_date' => '2025-08-09 00:00:00', 'end_date' => '2025-08-12 00:00:00', 'created_at' => '2025-08-09 05:36:24', 'updated_at' => '2025-08-15 02:13:09'],
            ['id' => '01988d55-2bce-71b0-a869-2e5b78cd3ecc', 'title' => 'Slider 3', 'subtitle' => NULL, 'image_path' => 'data-informasi/01K26NAAYB0A2QTPM6NFJ46WG9.jpeg', 'link_url' => NULL, 'order' => 3, 'is_active' => 1, 'start_date' => '2025-08-09 00:00:00', 'end_date' => '2025-08-15 00:00:00', 'created_at' => '2025-08-09 05:37:05', 'updated_at' => '2025-08-15 02:13:15']
        ]);
    }
}
