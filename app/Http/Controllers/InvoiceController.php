<?php


namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Location;
use App\Models\Property;
use App\Models\Penjualan;
use App\Models\Pengaturan;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Models\MasterWilayah;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function show($id)
    {


        // $penjualan = Penjualan::with('properti', 'pembeli')->findOrFail($id);
        $penjualan = Penjualan::with('properti', 'pembeli', 'lokasi')->findOrFail($id);

        $kelurahan = MasterWilayah::getNamaByKode($penjualan->kelurahan);
        $kecamatan = MasterWilayah::getNamaByKode($penjualan->kecamatan);
        $kabupaten = MasterWilayah::getNamaByKode($penjualan->kabupaten);
        $provinsi = MasterWilayah::getNamaByKode($penjualan->provinsi);

        $settings = Pengaturan::getAllAsArray();
        $pdf = Pdf::loadView('invoices.invoice', compact('penjualan', 'settings', 'kelurahan', 'kecamatan', 'kabupaten', 'provinsi'))->setPaper('a4', 'portrait');

        return $pdf->stream('invoice-' . $penjualan->id . '.pdf');
    }
}
