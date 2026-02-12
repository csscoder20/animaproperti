<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimoniSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('testimonis')->delete();

        DB::table('testimonis')->insert([
            ['id' => '0198b8be-28b7-7141-b632-ecbf5763d75b', 'nama' => 'Nurma Kumalasari', 'jabatan' => 'Pengusaha', 'pesan' => 'Saya sangat terbantu dengan layanan profesional tim ini. Dalam waktu singkat, saya berhasil menemukan rumah impian saya di lokasi yang strategis.', 'is_active' => 1, 'created_at' => '2025-08-17 15:55:26', 'updated_at' => '2025-08-17 15:55:26'],
            ['id' => '0198b8be-8b0c-71c9-9ff6-52e55c19da72', 'nama' => 'Ahmad Sibuni', 'jabatan' => 'Karyawan BUMN', 'pesan' => 'Proses pembelian berjalan mulus dan transparan. Saya merasa aman dan nyaman selama seluruh prosesnya. Sangat direkomendasikan!', 'is_active' => 1, 'created_at' => '2025-08-17 15:55:51', 'updated_at' => '2025-08-17 15:55:51'],
            ['id' => '0198b8c0-fb3e-7380-b4fd-f1094e6daea8', 'nama' => 'Christian Rantetampang', 'jabatan' => 'CEO', 'pesan' => 'Agen sangat responsif dan informatif. Mereka memberikan banyak opsi properti sesuai kebutuhan saya. Pelayanan terbaik yang pernah saya dapatkan.', 'is_active' => 1, 'created_at' => '2025-08-17 15:58:31', 'updated_at' => '2025-08-17 15:58:31'],
            ['id' => '0198b8c1-4a21-7378-884b-78e0ab802673', 'nama' => 'Arby Ardiansyah', 'jabatan' => 'Pilot', 'pesan' => 'Berbagai pilihan properti yang ditawarkan sangat lengkap dan terpercaya. Terima kasih telah membantu saya berinvestasi dengan tepat.', 'is_active' => 1, 'created_at' => '2025-08-17 15:58:51', 'updated_at' => '2025-08-17 15:58:51']
        ]);
    }
}
