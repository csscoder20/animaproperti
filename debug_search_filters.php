<?php

use App\Models\MasterWilayah;
use App\Models\Properti;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$keyword = 'Makasar';
// User inputs from screenshot
$guests = 4;
$checkin = '2026-02-18';

echo "Debugging Search for '$keyword' with Guests>=$guests and Checkin=$checkin\n\n";

// 1. Find matching codes from MasterWilayah (The part we know works)
$matchingWilayahCodes = MasterWilayah::where(function ($q) use ($keyword) {
    $q->where('nama', 'LIKE', '%' . $keyword . '%')
        ->orWhereRaw('SOUNDEX(nama) = SOUNDEX(?)', [$keyword])
        ->orWhereRaw("SOUNDEX(REPLACE(nama, 'Kota ', '')) = SOUNDEX(?)", [$keyword])
        ->orWhereRaw("SOUNDEX(REPLACE(nama, 'Kabupaten ', '')) = SOUNDEX(?)", [$keyword]);
})
    ->pluck('kode')
    ->toArray();

// 2. Search Properties with keyword ONLY
$properties = Properti::where('penawaran', 'Disewa')
    ->where(function ($q) use ($keyword, $matchingWilayahCodes) {
        $q->where('judul', 'LIKE', '%' . $keyword . '%')
            ->orWhere('alamat_lengkap', 'LIKE', '%' . $keyword . '%')
            ->orWhere(function ($subQ) use ($matchingWilayahCodes) {
                if (!empty($matchingWilayahCodes)) {
                    $subQ->whereIn('kecamatan', $matchingWilayahCodes)
                        ->orWhereIn('kabupaten', $matchingWilayahCodes)
                        ->orWhereIn('provinsi', $matchingWilayahCodes);
                }
            });
    })
    ->get();

echo "Found " . $properties->count() . " properties matching keyword '$keyword'.\n";

foreach ($properties as $prop) {
    echo "PROP: " . $prop->judul . "\n";
    echo "  CAPACITY: " . $prop->kapasitas_tamu . " (Req: $guests) -> " . ($prop->kapasitas_tamu >= $guests ? "PASS" : "FAIL") . "\n";
    echo "  AVAIL: " . ($prop->tersedia_dari ?? 'NULL') . " (Req: <=$checkin) -> " . ((is_null($prop->tersedia_dari) || $prop->tersedia_dari <= $checkin) ? "PASS" : "FAIL") . "\n";
}
