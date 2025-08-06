<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    public function berita(Request $request)
    {
        $title = 'Berita';

        $featuredPosts = Informasi::where('unggulan', 1)
            ->latest()
            ->take(5)
            ->get();

        // Ambil ID semua featured
        $featuredIds = $featuredPosts->pluck('id')->toArray();

        $posts = Informasi::whereNotIn('id', $featuredIds)
            ->latest()
            ->paginate(2);

        $latestBerita = Informasi::latest()
            ->take(5)
            ->get();

        return view('frontend.pages.news', compact('title', 'featuredPosts', 'posts', 'latestBerita'));
    }

    public function detail_berita($slug)
    {
        $title = 'Detail Berita';
        $data = Informasi::where('slug', $slug)->firstOrFail();

        // Tambahkan 1 ke jumlah 'lihat'
        $data->increment('lihat');

        // Ambil berita lain
        $otherPosts = Informasi::where('id', '!=', $data->id)
            ->latest()
            ->take(5)
            ->get();

        return view('frontend.pages.news-detail', compact('title', 'data', 'otherPosts'));
    }
}
