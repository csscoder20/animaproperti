<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agen;
use App\Models\Properti;

class AgenController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Agen';
        $agens = Agen::all(); // Ambil semua data agen

        return view('frontend.pages.agent', compact('title', 'agens'));
    }


    public function show($id)
    {
        // $agen = Agen::with('propertis.jenisProperti')->findOrFail($id);
        $agen = Agen::withCount('propertis')
            ->with('propertis.jenisProperti')
            ->findOrFail($id);

        $title = $agen->nama_lengkap;

        // Ambil properti milik agen
        $propertis = $agen->propertis;

        // Hitung jumlah properti per kategori
        $kategoriProperti = $propertis
            ->groupBy(fn($item) => optional($item->jenisProperti)->nama)
            ->map(fn($items, $kategori) => [
                'nama' => $kategori,
                'jumlah' => $items->count(),
            ])
            ->filter(fn($item) => $item['nama']) // Hapus null
            ->values();

        // Ambil wilayah (kabupaten) unik
        $wilayahProperti = $propertis
            ->groupBy('kabupaten')
            ->map(function ($items, $kabupaten) {
                return [
                    'nama' => $kabupaten,
                    'jumlah' => $items->count(),
                ];
            })
            ->filter(fn($item) => $item['nama']) // Filter null
            ->values();

        return view('frontend.pages.agent-detail', compact('agen', 'title', 'kategoriProperti', 'wilayahProperti'));
    }
}
