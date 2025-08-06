<?php

namespace Database\Seeders;

use App\Models\Informasi;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class InformasiSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        if (!$user) {
            $user = User::factory()->create();
        }

        $data = [
            [
                'judul' => 'Pembangunan Kawasan Perumahan Baru di Jayapura',
                'deskripsi' => 'Pemerintah bersama pengembang lokal meluncurkan proyek perumahan bersubsidi di kawasan Abepura, Jayapura. Proyek ini ditujukan untuk masyarakat menengah ke bawah.',
                'gambar' => '',
            ],
            [
                'judul' => 'Soft Launching Apartemen Modern di Makassar Timur',
                'deskripsi' => 'Sebuah apartemen berkonsep smart living telah resmi diperkenalkan di daerah Panakkukang. Dilengkapi dengan fasilitas modern dan akses transportasi mudah.',
                'gambar' => '',
            ],
            [
                'judul' => 'Pameran Properti Timur Indonesia 2025',
                'deskripsi' => 'Event tahunan ini menampilkan proyek properti unggulan dari kawasan Indonesia Timur seperti Maluku, Papua, dan NTT. Hadir juga promo eksklusif selama pameran berlangsung.',
                'gambar' => '',
            ],
            [
                'judul' => 'Seminar Investasi Properti Papua untuk Milenial',
                'deskripsi' => 'Acara ini membahas potensi besar investasi properti di Papua, khususnya untuk generasi muda yang ingin memulai investasi di sektor properti.',
                'gambar' => '',
            ],
            [
                'judul' => 'Progres Pembangunan Perumahan Subsidi di Sorong',
                'deskripsi' => 'PT XYZ Property melaporkan progres pembangunan tahap kedua untuk kompleks perumahan subsidi yang berlokasi di Sorong Barat telah mencapai 60%.',
                'gambar' => '',
            ],
        ];

        foreach ($data as $item) {
            Informasi::create([
                'id' => Str::uuid(),
                'judul' => $item['judul'],
                'deskripsi' => $item['deskripsi'],
                'gambar' => $item['gambar'],
                'slug' => Str::slug($item['judul']),
                'unggulan' => true,
                'lihat' => rand(10, 100),
                'user_id' => $user?->id,
            ]);
        }
    }
}
