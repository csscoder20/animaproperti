<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengaturanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pengaturans')->delete();

        DB::table('pengaturans')->insert([
            ['id' => '01987f5e-fe3d-72c9-8e44-a93dd5127c3f', 'key' => 'site_name', 'value' => 'animaproperty.id', 'created_at' => '2025-08-06 12:33:08', 'updated_at' => '2025-08-08 12:06:23'],
            ['id' => '01987f5e-fe3f-70c7-8a89-c4a786596563', 'key' => 'site_description', 'value' => 'Agen properti terpercaya di Makassar. Anima Properti bantu cari rumah baru, rumah dijual, dan hunian impian dari berbagai developer ternama.', 'created_at' => '2025-08-06 12:33:08', 'updated_at' => '2025-08-06 17:22:38'],
            ['id' => '01987f5e-fe3f-70c7-8a89-c4a7869824ed', 'key' => 'site_tagline', 'value' => 'Mewujudkan hunian impian Anda', 'created_at' => '2025-08-06 12:33:08', 'updated_at' => '2025-08-06 12:33:08'],
            ['id' => '01987f5e-fe40-712f-aeff-6d919af8dce2', 'key' => 'copyright', 'value' => '© Copyright Anima Properti | All Rights Reserved', 'created_at' => '2025-08-06 12:33:08', 'updated_at' => '2025-08-06 17:22:38'],
            ['id' => '01987f5e-fe40-712f-aeff-6d919b868eaa', 'key' => 'welcome_text', 'value' => 'Temukan Hunian Impian Anda', 'created_at' => '2025-08-06 12:33:08', 'updated_at' => '2025-08-07 13:21:16'],
            ['id' => '01987f5e-fe41-710d-89a7-f794951af359', 'key' => 'address', 'value' => 'Jl. Mutiara Boulevard - Ruko Saphire No.49 - Makassar', 'created_at' => '2025-08-06 12:33:08', 'updated_at' => '2025-08-06 12:33:08'],
            ['id' => '01987f5e-fe42-73bb-8ad5-a41c8c60dc3a', 'key' => 'postal_code', 'value' => '90243', 'created_at' => '2025-08-06 12:33:08', 'updated_at' => '2025-08-06 12:33:08'],
            ['id' => '01987f5e-fe43-722f-ab38-57ce77061bf9', 'key' => 'phone', 'value' => '+62 811-4617-733', 'created_at' => '2025-08-06 12:33:08', 'updated_at' => '2025-08-06 12:33:08'],
            ['id' => '01987f5e-fe43-722f-ab38-57ce773a25d0', 'key' => 'email', 'value' => 'propertianima@gmail.com', 'created_at' => '2025-08-06 12:33:08', 'updated_at' => '2025-08-06 12:33:08'],
            ['id' => '01987f5e-fe44-7384-9680-f849c8fef119', 'key' => 'facebook', 'value' => 'https://www.facebook.com/profile.php?id=61578622949198', 'created_at' => '2025-08-06 12:33:08', 'updated_at' => '2025-08-06 12:33:08'],
            ['id' => '01987f5e-fe45-72f0-a15b-af6e0b42f394', 'key' => 'instagram', 'value' => 'https://www.instagram.com/anima.properti/', 'created_at' => '2025-08-06 12:33:08', 'updated_at' => '2025-08-06 12:33:08'],
            ['id' => '01987f5e-fe45-72f0-a15b-af6e0c181767', 'key' => 'tiktok', 'value' => 'https://www.tiktok.com/@anima.properti', 'created_at' => '2025-08-06 12:33:08', 'updated_at' => '2025-08-06 12:33:08'],
            ['id' => '01987f5e-fe46-7195-b98b-e26bffc5420b', 'key' => 'youtube', 'value' => 'https://www.youtube.com/@AnimaProperti-RumahMakassar', 'created_at' => '2025-08-06 12:33:08', 'updated_at' => '2025-08-06 12:33:08'],
            ['id' => '01987f5e-fe46-7195-b98b-e26c0072b3e6', 'key' => 'twitter', 'value' => 'https://x.com/animaproperti', 'created_at' => '2025-08-06 12:33:08', 'updated_at' => '2025-08-07 08:28:58'],
            ['id' => '01987f5e-fe47-72a8-92cc-2e3642bf8d48', 'key' => 'logo', 'value' => 'logos/01K1ZNXZHR114K9N8HDEGN9SV7.jpg', 'created_at' => '2025-08-06 12:33:08', 'updated_at' => '2025-08-06 12:33:08']
        ]);
    }
}
