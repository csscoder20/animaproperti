<?php

use App\Models\MasterWilayah;
use App\Models\Properti;
use Illuminate\Support\Facades\DB;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$keyword = 'Makasar';

echo "Searching for keyword: '$keyword'\n";

// 1. Find matching codes from MasterWilayah
$matchingWilayahCodes = MasterWilayah::where(function ($q) use ($keyword) {
    $q->where('nama', 'LIKE', '%' . $keyword . '%')
        ->orWhereRaw('SOUNDEX(nama) = SOUNDEX(?)', [$keyword])
        ->orWhereRaw("SOUNDEX(REPLACE(nama, 'Kota ', '')) = SOUNDEX(?)", [$keyword])
        ->orWhereRaw("SOUNDEX(REPLACE(nama, 'Kabupaten ', '')) = SOUNDEX(?)", [$keyword]);
})
    ->pluck('kode')
    ->toArray();

echo "Found " . count($matchingWilayahCodes) . " matching wilayah codes.\n";

// 2. Search Properties
$properties = Properti::where('penawaran', 'Disewa')
    ->where(function ($q) use ($keyword, $matchingWilayahCodes) {
        // Search by Property Title
        $q->where('judul', 'LIKE', '%' . $keyword . '%')
            // Search by Full Address
            ->orWhere('alamat_lengkap', 'LIKE', '%' . $keyword . '%')
            // OR Search by Location matches
            ->orWhere(function ($subQ) use ($matchingWilayahCodes) {
            if (!empty($matchingWilayahCodes)) {
                $subQ->whereIn('kecamatan', $matchingWilayahCodes)
                    ->orWhereIn('kabupaten', $matchingWilayahCodes)
                    ->orWhereIn('provinsi', $matchingWilayahCodes);
            }
        });
    })
    ->get();

echo "Found " . $properties->count() . " properties.\n";

foreach ($properties as $prop) {
    echo "- " . $prop->judul . " (Loc: " . $prop->kecamatan . ", " . $prop->kabupaten . ")\n";
}
