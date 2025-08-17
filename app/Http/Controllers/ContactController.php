<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SKPrivasi;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Kontak';
        return view('frontend.pages.contact', compact('title'));
    }

    public function show($kategori)
    {
        $data = SKPrivasi::where('kategori', $kategori)->firstOrFail();

        $title = $data->judul ?? ($kategori === 'syarat-ketentuan' ? 'Syarat & Ketentuan' : 'Kebijakan Privasi');

        return view('frontend.pages.term', compact('title', 'data'));
    }
}
