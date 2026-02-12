<?php

namespace App\Http\Controllers;

use App\Models\Agen;
use App\Models\Properti;
use Illuminate\Http\Request;
use App\Models\JenisProperti;
use App\Models\MasterWilayah;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Daftar Properti';
        $query = Properti::with(['jenisProperti', 'agens'])->latest();

        // Tambahkan filter Agen
        if ($request->filled('agen_id')) {
            $query->whereHas('agens', function ($q) use ($request) {
                $q->where('agens.id', $request->agen_id);
            });
        }

        // Filter Lokasi (alamat)
        if ($request->filled('lokasi')) {
            $query->where('kecamatan', 'like', $request->lokasi . '%');
        }

        // Filter Tipe Properti
        if ($request->filled('tipe')) {
            $query->whereHas('jenisProperti', function ($q) use ($request) {
                $q->where('slug', $request->tipe);
            });
        }

        // Filter Jenis Penawaran
        if ($request->filled('offering')) {
            $query->where('penawaran', $request->offering);
        }

        // Filter Harga
        if ($request->filled('harga')) {
            switch ($request->harga) {
                case '<100':
                    $query->where('harga', '<', 100_000_000);
                    break;
                case '100-500':
                    $query->whereBetween('harga', [100_000_000, 500_000_000]);
                    break;
                case '500-1000':
                    $query->whereBetween('harga', [500_000_000, 1_000_000_000]);
                    break;
                case '>1000':
                    $query->where('harga', '>', 1_000_000_000);
                    break;
            }
        }

        // Filter Jumlah Kamar Tidur
        if ($request->filled('kamar') && $request->kamar !== 'any') {
            if ($request->kamar == 4) {
                $query->where('jumlah_kamar_tidur', '>=', 4);
            } else {
                $query->where('jumlah_kamar_tidur', $request->kamar);
            }
        }

        // Sorting
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'low-high':
                    $query->orderBy('harga', 'asc');
                    break;
                case 'high-low':
                    $query->orderBy('harga', 'desc');
                    break;
                case 'featured':
                    $query->orderByDesc('unggulan');
                    break;
                case 'latest':
                default:
                    $query->latest();
                    break;
            }
        }

        // Paginate hasil
        $properties = $query->paginate(12)->appends($request->query());
        $totalResults = $properties->total();

        $Tipepropertis = JenisProperti::all();
        $selectedType = $request->tipe;
        $selectedSort = $request->sort;
        $agenList = Agen::select('id', 'nama_lengkap')->get(); // untuk dropdown

        $selectedAgen = $request->agen_id;
        $filteredAgen = null;
        if ($selectedAgen) {
            $filteredAgen = Agen::find($selectedAgen);
        }


        $kecamatanList = MasterWilayah::whereIn('kode', function ($query) {
            $query->select(DB::raw('LEFT(kecamatan, 8)'))->from('propertis')->distinct();
        })
            ->orderBy('nama')
            ->get();

        // Properti terbaru untuk sidebar
        $latestProperties = Properti::latest()->take(5)->get();


        return view('frontend.pages.properties', compact(
            'title',
            'properties',
            'Tipepropertis',
            'totalResults',
            'selectedType',
            'kecamatanList',
            'selectedSort',
            'latestProperties',
            'agenList',
            'selectedAgen',
        ));
    }

    public function show($id)
    {
        $title = 'Detail Properti';

        $property = Properti::with(['jenisProperti', 'images', 'agens'])->findOrFail($id);
        $recommendedProperties = Properti::with('images')
            ->where('id', '!=', $id)
            ->latest()
            ->take(3)
            ->get();

        // Cek apakah kecamatan tersedia
        $alamatLengkap = $this->getAlamatLengkapProperti($property);

        $mapsUrl = $alamatLengkap
            ? 'https://www.google.com/maps?q=' . urlencode($alamatLengkap) . '&output=embed'
            : null;

        return view('frontend.pages.property-details', compact(
            'title',
            'property',
            'recommendedProperties',
            'mapsUrl',
            'alamatLengkap',
        ));
    }

    private function getAlamatLengkapProperti(Properti $property): string
    {
        $kelurahan = MasterWilayah::getNamaByKode($property->kelurahan);
        $kecamatan = MasterWilayah::getNamaByKode($property->kecamatan);
        $kabupaten = MasterWilayah::getNamaByKode($property->kabupaten);
        $provinsi  = MasterWilayah::getNamaByKode($property->provinsi);

        return implode(', ', array_filter([
            $property->alamat_lengkap,
            $kelurahan,
            $kecamatan,
            $kabupaten,
            $provinsi,
            $property->kode_pos,
        ]));
    }
}
