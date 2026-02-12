<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkPrivasiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sk_privasi')->delete();

        DB::table('sk_privasi')->insert([
            [
                'id' => '0198b8ba-ff8f-71fe-98ce-c18de4f69c4f',
                'judul' => 'Kebijakan Privasi Anima Properti',
                'kategori' => 'kebijakan-privasi',
                'isi' => '<p>Di Anima Properti, kami menghargai dan melindungi privasi Anda. Kebijakan privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, menyimpan, dan melindungi data pribadi Anda ketika menggunakan layanan kami, baik melalui website, aplikasi, maupun interaksi langsung dengan tim kami.<br><br><strong>1. Informasi yang Kami Kumpulkan</strong></p><ul><li>Kami dapat mengumpulkan beberapa jenis data pribadi, termasuk namun tidak terbatas pada:</li><li>Informasi identitas (nama lengkap, tanggal lahir, nomor identitas).</li><li>Informasi kontak (alamat, nomor telepon, email).</li><li>Informasi properti (kebutuhan, preferensi, lokasi, dan riwayat transaksi).</li><li>Informasi keuangan (jika diperlukan untuk transaksi pembelian/penyewaan).</li><li>Data penggunaan layanan (log aktivitas di website/aplikasi, cookies, alamat IP).</li></ul>...',
                'created_at' => '2025-08-17 15:51:59',
                'updated_at' => '2025-08-17 15:51:59'
            ],
            [
                'id' => '0198b8bb-461a-7332-af02-60670e2981c9',
                'judul' => 'Syarat dan Ketentuan Agen Properti Anima Properti',
                'kategori' => 'syarat-ketentuan',
                'isi' => '<p>Dokumen ini mengatur hak dan kewajiban antara Anima Properti (“Perusahaan”) dengan Agen Properti (“Agen”) yang bergabung dan bekerja sama dalam kegiatan pemasaran, penjualan, maupun penyewaan properti melalui platform dan jaringan Anima Properti.<br><br>Dengan mendaftar dan/atau menjalankan aktivitas sebagai Agen di Anima Properti, maka Agen dianggap telah membaca, memahami, dan menyetujui seluruh syarat dan ketentuan berikut:<br><br><strong>1. Pendaftaran dan Keanggotaan</strong><br>1.1. Agen wajib mengisi data diri dengan lengkap, benar, dan dapat dipertanggungjawabkan.<br>1.2. Perusahaan berhak melakukan verifikasi dan menolak pendaftaran apabila data yang diberikan tidak valid.<br>1.3. Agen wajib menjaga kerahasiaan akun yang diberikan dan bertanggung jawab penuh atas segala aktivitas yang dilakukan melalui akun tersebut...</p>',
                'created_at' => '2025-08-17 15:52:17',
                'updated_at' => '2025-08-17 15:52:17'
            ]
        ]);
    }
}
