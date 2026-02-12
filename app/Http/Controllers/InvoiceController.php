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
        $penjualan = Penjualan::with('properti', 'pelanggan', 'lokasi')->findOrFail($id);

        $kelurahan = $penjualan->kelurahan ? MasterWilayah::getNamaByKode($penjualan->kelurahan) : '-';
        $kecamatan = $penjualan->kecamatan ? MasterWilayah::getNamaByKode($penjualan->kecamatan) : '-';
        $kabupaten = $penjualan->kabupaten ? MasterWilayah::getNamaByKode($penjualan->kabupaten) : '-';
        $provinsi = $penjualan->provinsi ? MasterWilayah::getNamaByKode($penjualan->provinsi) : '-';

        $settings = Pengaturan::getAllAsArray();
        $pdf = Pdf::loadView('invoices.invoice', compact('penjualan', 'settings', 'kelurahan', 'kecamatan', 'kabupaten', 'provinsi'))->setPaper('a4', 'portrait');

        return $pdf->stream('invoice-' . $penjualan->id . '.pdf');
    }

    public function showPenyewaan($id)
    {
        $penyewaan = \App\Models\Penyewaan::with('properti', 'pelanggan')->findOrFail($id);

        $settings = Pengaturan::getAllAsArray();

        // Load partial location data from properti if available
        $properti = $penyewaan->properti;
        $kelurahan = $properti->kelurahan ? MasterWilayah::getNamaByKode($properti->kelurahan) : '-';
        $kecamatan = $properti->kecamatan ? MasterWilayah::getNamaByKode($properti->kecamatan) : '-';
        $kabupaten = $properti->kabupaten ? MasterWilayah::getNamaByKode($properti->kabupaten) : '-';
        $provinsi = $properti->provinsi ? MasterWilayah::getNamaByKode($properti->provinsi) : '-';

        $pdf = Pdf::loadView('invoices.penyewaan', compact('penyewaan', 'settings', 'kelurahan', 'kecamatan', 'kabupaten', 'provinsi'))->setPaper('a4', 'portrait');

        $filename = 'Kuitansi Sewa-Kontrak Properti - ' . ($penyewaan->properti->judul ?? 'N-A') . ' - ' . ($penyewaan->pelanggan->nama ?? 'N-A') . '.pdf';

        return $pdf->stream($filename);
    }
}
