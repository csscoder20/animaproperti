<?php

namespace App\Http\Controllers;

use App\Models\Agen;
use App\Models\Slider;
use App\Models\Properti;
use App\Models\Informasi;
use App\Models\Testimoni;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\JenisProperti;
use App\Models\MasterWilayah;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Beranda';

        $sliders = Slider::active()
            ->orderBy('order')
            ->get();

        $rentProperties = Properti::where('penawaran', 'Disewa')
            ->where('status', 'Tersedia')
            ->latest()
            ->take(6)
            ->get();

        $featuredProperty = Properti::with([
            'images' => fn($query) => $query->take(2),
            'agens',
        ])
            ->where('unggulan', 1)
            ->where('status', 'Tersedia')
            ->latest()
            ->first();

        $sellProperties = Properti::where('penawaran', 'Dijual')
            ->where('status', 'Tersedia')
            ->latest()
            ->take(6)
            ->get();

        $latestProperties = Properti::with('images')
            ->where('status', 'Tersedia')
            ->latest()
            ->take(4)
            ->get();

        $propertyTypes = JenisProperti::orderBy('nama')->get();

        $propertyAgen = Agen::withCount('propertis')
            ->whereHas('propertis', function ($query) {
                $query->where('status', 'Tersedia');
            })
            ->orderBy('nama_lengkap')
            ->get();

        $kecamatanList = MasterWilayah::whereIn('kode', function ($query) {
            $query->select(DB::raw('LEFT(kelurahan, 8)'))->from('propertis')->distinct();
        })
            ->orderBy('nama')
            ->get();

        // 🔹 Ambil berita untuk home
        $beritaHome = Informasi::where('home', 1)
            ->latest()
            ->take(6)
            ->get()
            ->map(function ($berita) {
                $berita->deskripsi_terbatas = Str::limit($berita->deskripsi, 80, '...');
                return $berita;
            });

        // Ambil testimoni aktif
        $testimonis = Testimoni::where('is_active', true)
            ->latest()
            ->get();

        return view('frontend.pages.home', compact(
            'sliders',
            'latestProperties',
            'rentProperties',
            'sellProperties',
            'propertyTypes',
            'title',
            'kecamatanList',
            'featuredProperty',
            'propertyAgen',
            'beritaHome',
            'testimonis',
        ));
    }



    // Detail properti berdasarkan ID
    public function show($id)
    {
        $title = 'Detail Properti';
        $property = Properti::findOrFail($id);

        return view('frontend.pages.property-details', compact('property'));
    }

    public function searchRedirect(Request $request)
    {
        return redirect()->route('properties.index', $request->query());
    }
}
