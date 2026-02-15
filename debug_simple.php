
<?php

use App\Models\Properti;
use Illuminate\Http\Request;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- Simulating Advanced Utilization Logic (Simple) ---\n";

// Find Apartemen
$prop = Properti::where('judul', 'LIKE', '%Apartemen%')->first();
if (!$prop) die("Apartemen not found");

// Force update capacity: 2 Adults, 3 Children
$prop->kapasitas_dewasa_per_kamar = 2;
$prop->kapasitas_anak_per_kamar = 3;
$prop->kapasitas_tamu = 0; 
$prop->save();

function checkSearch($a, $c, $r) {
    global $prop;
    $adults = $a; $children = $c; $rooms = $r;
    
    $exists = Properti::where('id', $prop->id)
        ->where(function ($q) use ($adults, $children, $rooms) {
             $q->whereRaw("
                (
                    IF(COALESCE(kapasitas_dewasa_per_kamar, 0) > 0, ? / kapasitas_dewasa_per_kamar, IF(? > 0, 1000, 0)) +
                    IF(COALESCE(kapasitas_anak_per_kamar, 0) > 0, ? / kapasitas_anak_per_kamar, IF(? > 0, 1000, 0))
                ) <= ?
            ", [$adults, $adults, $children, $children, $rooms]);
        })->exists();
        
    echo "Search ($a A, $c C, $r Rm): " . ($exists ? "PASS" : "FAIL") . "\n";
}

checkSearch(1, 1, 1); // 0.83 <= 1 -> PASS
checkSearch(2, 0, 1); // 1.0 <= 1 -> PASS
checkSearch(2, 1, 1); // 1.33 <= 1 -> FAIL

