<?php

namespace App\Http\Controllers;

use App\Models\Agen;
use App\Models\Properti;
use Illuminate\Http\Request;
use App\Models\JenisProperti;
use App\Models\MasterWilayah;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Beranda';

        // Ambil 6 properti untuk disewa
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

        // Ambil 6 properti untuk dijual
        $sellProperties = Properti::where('penawaran', 'Dijual')
            ->where('status', 'Tersedia')
            ->latest()
            ->take(6)
            ->get();

        // Ambil 4 properti terbaru
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

        return view('frontend.pages.home', compact(
            'latestProperties',
            'rentProperties',
            'sellProperties',
            'propertyTypes',
            'title',
            'kecamatanList',
            'featuredProperty',
            'propertyAgen',
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
