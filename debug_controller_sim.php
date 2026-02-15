
<?php

use App\Models\Properti;
use App\Models\MasterWilayah;
use Illuminate\Support\Facades\DB;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

DB::enableQueryLog();

$keyword = 'makasar';

// 1. Get Matching Wilayah Codes
$matchingWilayahCodes = MasterWilayah::where(function ($q) use ($keyword) {
    $q->where('nama', 'LIKE', '%' . $keyword . '%')
        ->orWhereRaw('SOUNDEX(nama) = SOUNDEX(?)', [$keyword])
        ->orWhereRaw("SOUNDEX(REPLACE(nama, 'Kota ', '')) = SOUNDEX(?)", [$keyword])
        ->orWhereRaw("SOUNDEX(REPLACE(nama, 'Kabupaten ', '')) = SOUNDEX(?)", [$keyword]);
})
->pluck('kode')
->toArray();

echo "Matching Codes Count: " . count($matchingWilayahCodes) . "\n";
if (in_array('73.71.03', $matchingWilayahCodes)) {
    echo "Code 73.71.03 (Makassar) IS in matching codes.\n";
} else {
    echo "Code 73.71.03 (Makassar) IS NOT in matching codes.\n";
}

// 2. Build Property Query
$query = Properti::with(['jenisProperti', 'agens'])
    ->where('penawaran', 'Disewa')
    ->whereHas('jenisProperti', function ($q) {
        $q->whereIn('slug', ['kost', 'apartemen']);
    })
    ->latest();

$query->where(function ($q) use ($keyword, $matchingWilayahCodes) {
    $q->where('judul', 'LIKE', '%' . $keyword . '%')
        ->orWhere('alamat_lengkap', 'LIKE', '%' . $keyword . '%')
        ->orWhereHas('jenisProperti', function ($qType) use ($keyword) {
            $qType->where('nama', 'LIKE', '%' . $keyword . '%');
        })
        ->orWhere(function ($subQ) use ($matchingWilayahCodes) {
            if (!empty($matchingWilayahCodes)) {
                $subQ->whereIn('kecamatan', $matchingWilayahCodes)
                    ->orWhereIn('kabupaten', $matchingWilayahCodes)
                    ->orWhereIn('provinsi', $matchingWilayahCodes);
            }
        });
});

$results = $query->get();
echo "Query Results Count: " . $results->count() . "\n";

foreach ($results as $r) {
    echo "Found: " . $r->judul . " (" . $r->kecamatan . ")\n";
}

// Output SQL
// print_r(DB::getQueryLog());
