<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TentangKamiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tentang_kamis')->delete();

        DB::table('tentang_kamis')->insert([
            ['id' => '01987f58-d154-73ff-b097-8a14d9f80b52', 'key' => 'about_title', 'value' => 'Anima Properti', 'created_at' => '2025-08-06 12:26:23', 'updated_at' => '2025-08-06 12:26:23'],
            ['id' => '01987f58-d155-7163-b2bb-5b3459c963ff', 'key' => 'about_description', 'value' => '<p>Anima Properti adalah agen properti terpercaya di Makassar yang membantu Anda menemukan rumah idaman dengan proses mudah, aman, dan transparan. Kami melayani jual beli rumah dari berbagai developer ternama, termasuk Summarecon Mutiara Makassar dan perumahan lainnya di Indonesia Timur. Dengan pengalaman, pengetahuan lokal, dan pendekatan personal, kami hadir untuk mewujudkan hunian impian Anda.<br><br><br></p>', 'created_at' => '2025-08-06 12:26:23', 'updated_at' => '2025-08-06 12:26:23'],
            ['id' => '01987f58-d156-71dc-bfdd-206f0c52dcfe', 'key' => 'visi', 'value' => '<p>Menjadi agen properti terdepan dan paling dipercaya di Makassar dan kawasan Indonesia Timur, sebagai pilihan utama masyarakat dalam membeli rumah baru yang berkualitas dan bernilai investasi.</p>', 'created_at' => '2025-08-06 12:26:23', 'updated_at' => '2025-08-06 12:26:23'],
            ['id' => '01987f58-d156-71dc-bfdd-206f0cb8d679', 'key' => 'misi', 'value' => '<ul><li>Memberikan layanan konsultasi properti yang jujur, profesional, dan personal.</li><li>Menyediakan pilihan rumah terbaik dari berbagai developer terpercaya.</li><li>Membangun hubungan jangka panjang dengan pelanggan melalui kepercayaan dan integritas.</li><li>Mengedukasi masyarakat tentang proses jual beli properti secara mudah dan aman.</li><li>Menjadi jembatan antara developer dan pembeli yang mengedepankan kepuasan kedua&nbsp;belah&nbsp;pihak.</li></ul>', 'created_at' => '2025-08-06 12:26:23', 'updated_at' => '2025-08-06 12:26:23'],
            ['id' => '01987f58-d157-735b-b2f0-9f3c195d6930', 'key' => 'about_image', 'value' => 'about/01K1ZNHMAHPFEDAQ6XCFJZ6RDJ.jpg', 'created_at' => '2025-08-06 12:26:23', 'updated_at' => '2025-08-06 12:26:23'],
            ['id' => '01987f58-d158-71ac-8537-c1b510110a50', 'key' => 'property_sold', 'value' => '18', 'created_at' => '2025-08-06 12:26:23', 'updated_at' => '2025-09-16 11:18:29'],
            ['id' => '01987f58-d158-71ac-8537-c1b510d01074', 'key' => 'happy_clients', 'value' => '18', 'created_at' => '2025-08-06 12:26:23', 'updated_at' => '2025-09-16 11:18:29'],
            ['id' => '01987f58-d159-70b6-832f-9e7fa38acf27', 'key' => 'years_of_experience', 'value' => '20', 'created_at' => '2025-08-06 12:26:23', 'updated_at' => '2025-08-06 12:26:23'],
            ['id' => '01987f58-d159-70b6-832f-9e7fa473ab97', 'key' => 'rating', 'value' => '5', 'created_at' => '2025-08-06 12:26:23', 'updated_at' => '2025-08-06 12:26:23']
        ]);
    }
}
