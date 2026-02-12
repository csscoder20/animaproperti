<?php

namespace Database\Seeders;

use App\Models\Informasi;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class InformasiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('informasis')->delete();

        $data = [
            [
                'id' => '01988ceb-a8e2-7277-b0be-ea06e346ac88',
                'judul' => 'Anima Properti hadir Di Makassar - Solusi Cerdas Beli & Jual Rumah',
                'deskripsi' => '<p>Makassar, [4 Agustus 2025] – Kabar baik untuk masyarakat Makassar dan wilayah Indonesia Timur! Anima Properti, agen properti terpercaya dan berpengalaman, kini resmi hadir untuk membantu Anda menemukan hunian impian maupun menjual properti dengan cepat dan menguntungkan.<br><br>Didirikan oleh Anita Maya Kesuma, seorang profesional properti dengan lebih dari 15 tahun pengalaman sebagai marketing di Ciputra dan Summarecon Makassar, Anima Properti hadir dengan standar layanan tinggi, strategi pemasaran modern, dan jaringan pembeli yang luas.<br><br>Dengan pengalamannya yang panjang dan reputasi yang terjaga di industri properti, Anita Maya Kesuma memahami betul bahwa membeli rumah bukan sekadar transaksi, tetapi sebuah keputusan besar yang menyangkut masa depan keluarga.<br><br>&gt; <em>“Kami percaya bahwa membeli rumah bukan hanya soal transaksi, tetapi tentang menemukan tempat terbaik untuk membangun kehidupan dan masa depan,” ujar Anita Maya Kesuma, Direktur Anima Properti.</em><br><br><br><br>Layanan Unggulan Anima Properti<br><br>1. Penjualan Rumah Baru &amp; Second – Pilihan properti mulai dari perumahan modern, rumah mewah, hingga hunian terjangkau.<br>2. Titip Jual Properti – Membantu pemilik rumah memasarkan properti dengan strategi digital marketing terkini.<br>3. Konsultasi Properti Gratis – Memberi panduan lokasi, desain rumah, hingga potensi investasi.<br>4. Jaringan Developer Luas – Tidak terbatas pada satu pengembang, sehingga pilihan rumah lebih bervariasi.<br><br><br><br>Mengapa Memilih Anima Properti?<br><br>Berpengalaman lebih dari 15 tahun di dunia pemasaran properti premium<br>Jujur &amp; Transparan dalam setiap proses transaksi<br>Strategi Pemasaran Modern lewat media sosial, website, dan jaringan pembeli yang luas<br>Fokus di Pasar Makassar &amp; Indonesia Timur, sehingga lebih memahami kebutuhan lokal<br><br><br>Kantor Anima Properti berlokasi di:<br>📍 Jl. Mutiara Boulevard, Ruko Saphire No.49, Bulurokeng, Makassar.<br><br>Tentang Anima Properti<br><br>Anima Properti adalah bagian dari CV. Anima Karya Property yang bergerak di bidang jual beli dan pemasaran properti di Makassar dan Indonesia Timur. Dengan mengedepankan pelayanan ramah, profesional, dan teknologi pemasaran terkini, Anima Properti berkomitmen menjadi mitra terpercaya bagi setiap klien.<br>---<br><br>Hubungi Anima Properti Hari Ini!<br>📱 WhatsApp: +62 811-4617-733<br>🌐 Website: animaproperty.id<br>📸 Instagram: @anima_properti<br><br>Temukan rumah impian Anda bersama Anima Properti – Properti Impian, Layanan Terpercaya.</p>',
                'gambar' => 'data-informasi/01K26EQA6CPQKG61A1KHDXXWF1.webp',
                'slug' => 'anima-properti-hadir-di-makassar-solusi-cerdas-beli-jual-rumah',
                'lihat' => 124,
                'unggulan' => 1,
                'home' => 1,
                'user_id' => 2,
                'created_at' => '2025-08-09 03:41:51',
                'updated_at' => '2026-02-09 18:29:43'
            ],
            [
                'id' => '01988d06-52b0-72cd-b13b-e23d2f24df08',
                'judul' => 'Anima Properti Resmi Jadi Mitra Penjualan Premier Avenue Makassar',
                'deskripsi' => '<p>Makassar, 2 Agustus 2025 – Anima Properti, agen properti terpercaya yang dipimpin oleh Anita Maya Kesuma dengan pengalaman lebih dari 15 tahun di pemasaran properti Ciputra dan Summarecon, kini resmi menjalin Perjanjian Kerjasama (PKS) dengan Premier Avenue Makassar.<br><br>Penandatanganan PKS ini berlangsung di kantor pemasaran Premier Avenue Makassar dalam suasana hangat dan profesional. Kolaborasi ini bertujuan untuk memperluas jaringan pemasaran dan memudahkan masyarakat Makassar serta kawasan Indonesia Timur mendapatkan hunian eksklusif dengan kualitas terbaik.<br><br>“Kerjasama ini menjadi langkah strategis bagi Anima Properti untuk memberikan lebih banyak pilihan hunian modern dan strategis kepada masyarakat. Premier Avenue memiliki konsep yang sesuai dengan kebutuhan keluarga masa kini,” ujar Anita Maya Kesuma, Owner Anima Properti.<br><br>Melalui kemitraan ini, Anima Properti akan menjadi mitra resmi penjualan Premier Avenue Makassar, memberikan layanan konsultasi properti, pendampingan pembelian, dan proses transaksi yang transparan serta aman bagi calon pembeli.<br><br>Premier Avenue Makassar sendiri dikenal sebagai kawasan hunian modern dengan desain elegan, fasilitas lengkap, dan lokasi strategis, menjadikannya pilihan tepat untuk hunian maupun investasi properti jangka panjang.<br><br>Kerjasama ini diharapkan mampu meningkatkan penjualan unit Premier Avenue dan semakin mengukuhkan Anima Properti sebagai agen properti profesional, berpengalaman, dan terpercaya&nbsp;di&nbsp;Makassar.</p>',
                'gambar' => 'data-informasi/01K26GCMNDKRPWENB0JZZGWDVF.jpg',
                'slug' => 'anima-properti-resmi-jadi-mitra-penjualan-premier-avenue-makassar',
                'lihat' => 110,
                'unggulan' => 0,
                'home' => 1,
                'user_id' => 2,
                'created_at' => '2025-08-09 04:10:58',
                'updated_at' => '2026-02-10 05:36:56'
            ],
            [
                'id' => '01988d0e-05c4-7225-a2bc-d85a3109eedd',
                'judul' => 'Rumah di Cluster Anthura Tallasa City Makassar Kini Bisa Dipesan di Anima Properti',
                'deskripsi' => '<p>Makassar, 9 Agustus 2025 – Kabar gembira bagi Anda yang sedang mencari hunian modern, ramah lingkungan, dan berlokasi strategis di Makassar. Cluster Anthura, salah satu klaster premium di Tallasa City Makassar, kini resmi dapat dipesan melalui Anima Properti.<br><br>Cluster Anthura menjadi perumahan ramah energi dan lingkungan pertama di Indonesia Timur yang mengusung konsep eco-friendly living. Didesain dengan teknologi hemat energi, pencahayaan alami, dan pengelolaan air yang efisien, klaster ini menawarkan kenyamanan hidup sekaligus kepedulian terhadap lingkungan.<br><br>Fasilitas Lengkap di Cluster Anthura<br><br>Clubhouse modern<br><br>Kolam renang eksklusif<br><br>Area hijau dan taman bermain anak<br><br>Sistem keamanan 24 jam<br><br>Akses mudah ke pusat kota dan fasilitas publik<br><br><br>Selain fasilitas yang memanjakan, lokasi Cluster Anthura berada di dalam kawasan Tallasa City Makassar yang dikembangkan dengan konsep kota mandiri modern, sehingga penghuni dapat menikmati lingkungan yang tertata rapi, aman, dan nyaman.<br><br>“Dengan dibukanya pemesanan rumah di Cluster Anthura melalui Anima Properti, kami ingin memberikan kemudahan bagi calon pembeli untuk mendapatkan hunian berkualitas tinggi dengan proses yang cepat, aman, dan transparan,” ujar Anita Maya Kesuma, Owner Anima Properti yang memiliki pengalaman lebih dari 15 tahun di industri properti.<br><br>💡 Jangan tunda lagi! Unit di Cluster Anthura terbatas dan permintaan tinggi. Segera hubungi tim Anima Properti untuk mendapatkan informasi harga, promo spesial, dan jadwal kunjungan show unit.<br>📲 Hubungi WA: +62 811-4617-733<br>🌐 Kunjungi: animaproperty.id</p>',
                'gambar' => 'data-informasi/01K26GW1E1PXBNBEDSVK7WSRZY.webp',
                'slug' => 'rumah-di-cluster-anthura-tallasa-city-makassar-kini-bisa-dipesan-di-anima-properti',
                'lihat' => 135,
                'unggulan' => 0,
                'home' => 1,
                'user_id' => 2,
                'created_at' => '2025-08-09 04:19:23',
                'updated_at' => '2026-02-09 18:04:15'
            ],
            [
                'id' => '01988daf-1947-725f-b40d-4203f2d96e65',
                'judul' => 'Pameran Properti Timur Indonesia 2025',
                'deskripsi' => '<p>Makassar, [4 Agustus 2025] – Kabar baik untuk masyarakat Makassar dan wilayah Indonesia Timur! Anima Properti, agen properti terpercaya dan berpengalaman, kini resmi hadir untuk membantu Anda menemukan hunian impian maupun menjual properti dengan cepat dan menguntungkan.<br><br>Didirikan oleh Anita Maya Kesuma, seorang profesional properti dengan lebih dari 15 tahun pengalaman sebagai marketing di Ciputra dan Summarecon Makassar, Anima Properti hadir dengan standar layanan tinggi, strategi pemasaran modern, dan jaringan pembeli yang luas.<br><br>Dengan pengalamannya yang panjang dan reputasi yang terjaga di industri properti, Anita Maya Kesuma memahami betul bahwa membeli rumah bukan sekadar transaksi, tetapi sebuah keputusan besar yang menyangkut masa depan keluarga.<br><br>&gt; <em>“Kami percaya bahwa membeli rumah bukan hanya soal transaksi, tetapi tentang menemukan tempat terbaik untuk membangun kehidupan dan masa depan,” ujar Anita Maya Kesuma, Direktur Anima Properti.</em><br><br><br><br>Layanan Unggulan Anima Properti<br><br>1. Penjualan Rumah Baru &amp; Second – Pilihan properti mulai dari perumahan modern, rumah mewah, hingga hunian terjangkau.<br>2. Titip Jual Properti – Membantu pemilik rumah memasarkan properti dengan strategi digital marketing terkini.<br>3. Konsultasi Properti Gratis – Memberi panduan lokasi, desain rumah, hingga potensi investasi.<br>4. Jaringan Developer Luas – Tidak terbatas pada satu pengembang, sehingga pilihan rumah lebih bervariasi.<br><br><br><br>Mengapa Memilih Anima Properti?<br><br>Berpengalaman lebih dari 15 tahun di dunia pemasaran properti premium<br>Jujur &amp; Transparan dalam setiap proses transaksi<br>Strategi Pemasaran Modern lewat media sosial, website, dan jaringan pembeli yang luas<br>Fokus di Pasar Makassar &amp; Indonesia Timur, sehingga lebih memahami kebutuhan lokal<br><br><br>Kantor Anima Properti berlokasi di:<br>📍 Jl. Mutiara Boulevard, Ruko Saphire No.49, Bulurokeng, Makassar.<br><br>Tentang Anima Properti<br><br>Anima Properti adalah bagian dari CV. Anima Karya Property yang bergerak di bidang jual beli dan pemasaran properti di Makassar dan Indonesia Timur. Dengan mengedepankan pelayanan ramah, profesional, dan teknologi pemasaran terkini, Anima Properti berkomitmen menjadi mitra terpercaya bagi setiap klien.<br>---<br><br>Hubungi Anima Properti Hari Ini!<br>📱 WhatsApp: +62 811-4617-733<br>🌐 Website: animaproperty.id<br>📸 Instagram: @anima_properti<br><br>Temukan rumah impian Anda bersama Anima Properti – Properti Impian, Layanan Terpercaya.</p>',
                'gambar' => 'data-informasi/01K26TY6A2RSGMBPY94GRAM897.jpg',
                'slug' => 'pameran-properti-timur-indonesia-2025',
                'lihat' => 101,
                'unggulan' => 0,
                'home' => 1,
                'user_id' => 2,
                'created_at' => '2025-08-09 07:15:19',
                'updated_at' => '2026-02-10 06:35:06'
            ],
            [
                'id' => '0198a62d-0840-73b9-9294-d60634b9afea',
                'judul' => 'Tim Anima Properti Kunjungi Virginia Park – Hunian Modern dengan Fasilitas Lengkap di Lokasi Strategis',
                'deskripsi' => '<p>Makassar – Tim agen dari Anima Properti, yang dipimpin langsung oleh owner Anita Maya Kesuma, melakukan kunjungan eksklusif ke kawasan Virginia Park pada [tanggal kunjungan]. Tujuan kunjungan ini adalah melihat langsung kualitas bangunan, fasilitas, serta suasana lingkungan perumahan yang kini menjadi salah satu pilihan favorit pembeli rumah di Makassar dan kawasan Indonesia Timur.<br><br>Virginia Park hadir dengan konsep hunian modern berdesain elegan, memadukan kenyamanan, keamanan, dan kemudahan akses ke berbagai pusat kota. Dalam kunjungan tersebut, tim Anima Properti mengunjungi show unit, meninjau fasilitas umum seperti taman dan area bermain, serta berdiskusi langsung dengan pengembang mengenai keunggulan dan rencana pengembangan kawasan.<br><br>“Melihat langsung seperti ini membuat kami semakin percaya untuk merekomendasikan Virginia Park kepada klien. Lokasinya sangat strategis, kualitas bangunannya terjamin, dan lingkungannya asri,” ujar Anita Maya Kesuma, yang telah berpengalaman lebih dari 15 tahun di industri properti Ciputra dan Summarecon Makassar.<br><br>Dengan reputasi sebagai agen properti terpercaya, Anima Properti terus berkomitmen memberikan pilihan hunian terbaik yang sesuai kebutuhan keluarga dan investor. Kunjungan ke Virginia Park ini diharapkan membantu calon pembeli mendapatkan informasi akurat, lengkap, dan terpercaya sebelum memutuskan membeli rumah.<br><br>Hubungi Kami:<br>📞 ‪+62 811-4617-733‬<br>🌐 animaproperty.id<br>📍 Jadwalkan survei ke Virginia Park bersama tim Anima Properti sekarang dan temukan hunian&nbsp;impian&nbsp;Anda!</p>',
                'gambar' => 'data-informasi/01K2K2T21YSYGKRG0JHPCBDNPV.webp',
                'slug' => 'tim-anima-properti-kunjungi-virginia-park-hunian-modern-dengan-fasilitas-lengkap-di-lokasi-strategis',
                'lihat' => 119,
                'unggulan' => 0,
                'home' => 1,
                'user_id' => 2,
                'created_at' => '2025-08-14 01:23:45',
                'updated_at' => '2026-02-09 23:32:58'
            ],
            [
                'id' => '0198eaed-ffab-71e9-949e-e3d9c0c375e6',
                'judul' => 'Tim Anima Properti Kunjungi Developer Golden Cendrawasih Makassar untuk Product Knowledge',
                'deskripsi' => '<p>📍 Makassar, 26 Agustus 2025 –<br>Dalam rangka meningkatkan pengetahuan produk dan memperkuat hubungan kerja sama dengan pihak developer, tim Anima Properti melakukan kunjungan resmi ke Golden Cendrawasih Makassar. Agenda ini menjadi bagian penting dari komitmen Anima Properti untuk menghadirkan informasi yang akurat dan terpercaya kepada para calon konsumen.<br><br>Kunjungan ini diisi dengan sesi product knowledge, di mana tim Anima Properti mendapatkan penjelasan mendalam mengenai konsep perumahan, keunggulan desain, spesifikasi bangunan, serta prospek investasi dari unit-unit hunian yang ditawarkan oleh Golden Cendrawasih.<br><br>&gt; “Kami ingin memastikan setiap informasi yang kami sampaikan kepada klien benar-benar sesuai dengan fakta di lapangan. Dengan adanya kunjungan ini, tim kami dapat lebih percaya diri menjelaskan detail produk dan memberikan rekomendasi terbaik bagi masyarakat yang mencari hunian,” ujar perwakilan Anima Properti.<br><br>Selain sesi presentasi, tim Anima Properti juga berkesempatan meninjau langsung show unit yang tersedia. Hal ini memberikan gambaran nyata mengenai kualitas material, tata ruang, dan kenyamanan hunian yang menjadi nilai jual utama Golden Cendrawasih.<br><br>Kegiatan ini tidak hanya memperkaya wawasan tim Anima Properti, tetapi juga memperkuat sinergi dengan developer sebagai mitra strategis dalam menghadirkan pilihan hunian berkualitas bagi masyarakat Makassar dan sekitarnya.</p>',
                'gambar' => 'data-informasi/01K3NEVZX7WSNM95AN3WDS8RCG.webp',
                'slug' => 'tim-anima-properti-kunjungi-developer-golden-cendrawasih-makassar-untuk-product-knowledge',
                'lihat' => 99,
                'unggulan' => 0,
                'home' => 0,
                'user_id' => 2,
                'created_at' => '2025-08-27 09:48:42',
                'updated_at' => '2026-02-09 18:04:14'
            ],
        ];

        DB::table('informasis')->insert($data);
    }
}
