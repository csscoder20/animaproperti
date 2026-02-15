
<?php

use App\Models\Properti;
use Illuminate\Http\Request;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- Simulating Advanced Utilization Logic ---\n";

// create a fake property or find one to test against
// Let's use the Apartemen we know exists.
$prop = Properti::where('judul', 'LIKE', '%Apartemen%')->first();
if (!$prop) die("Apartemen not found");

// Force update its capacity for testing
// Cap: 2 Adults, 3 Children
$prop->kapasitas_dewasa_per_kamar = 2;
$prop->kapasitas_anak_per_kamar = 3;
$prop->kapasitas_tamu = 0; // Ensure legacy doesn't interfere
$prop->save();

echo "Property: " . $prop->judul . "\n";
echo "Capacity: 2 Adults, 3 Children per Room.\n";

function testSearch($a, $c, $r) {
    global $prop;
    echo "\nTesting: $a Adults, $c Children, $r Rooms... ";
    
    // Mimic Controller Logic
    $adults = $a;
    $children = $c;
    $rooms = $r;
    $totalGuests = $a + $c;

    $matches = Properti::where('id', $prop->id)
        ->where(function ($q) use ($adults, $children, $rooms, $totalGuests) {
            $q->where(function ($sub) use ($adults, $children, $rooms) {
                $sub->whereRaw('(COALESCE(kapasitas_dewasa_per_kamar, 0) > 0 OR COALESCE(kapasitas_anak_per_kamar, 0) > 0)')
                    ->whereRaw("
                        (
                            IF(COALESCE(kapasitas_dewasa_per_kamar, 0) > 0, ? / kapasitas_dewasa_per_kamar, IF(? > 0, 1000, 0)) +
                            IF(COALESCE(kapasitas_anak_per_kamar, 0) > 0, ? / kapasitas_anak_per_kamar, IF(? > 0, 1000, 0))
                        ) <= ?
                    ", [$adults, $adults, $children, $children, $rooms]);
            })
            ->orWhere(function ($sub) use ($totalGuests) {
                $sub->whereRaw('(COALESCE(kapasitas_dewasa_per_kamar, 0) = 0 AND COALESCE(kapasitas_anak_per_kamar, 0) = 0)')
                    ->where('kapasitas_tamu', '>=', $totalGuests);
            });
        })->count();

    if ($matches > 0) echo "MATCH (Allowed)\n";
    else echo "NO MATCH (Blocked)\n";
    
    // Calculate expected
    $util = ($a/2) + ($c/3);
    echo "Utilization: $util <= $r ? " . ($util <= $r ? "YES" : "NO") . "\n";
}

testSearch(1, 1, 1); // 0.5 + 0.33 = 0.83 <= 1. Should MATCH.
testSearch(2, 0, 1); // 1.0 + 0 = 1.0 <= 1. Should MATCH.
testSearch(0, 3, 1); // 0 + 1.0 = 1.0 <= 1. Should MATCH.
testSearch(2, 1, 1); // 1.0 + 0.33 = 1.33 > 1. Should BLOCK.
testSearch(2, 2, 1); // 1.0 + 0.66 = 1.66 > 1. Should BLOCK.
testSearch(4, 6, 2); // 2.0 + 2.0 = 4.0 <= 2? No. Wait. (4/2) + (6/3) = 2 + 2 = 4 > 2 Rooms?
// Wait. 4 Adults = 2 Rooms. 6 Children = 2 Rooms. Total 4 Rooms needed?
// My formula: (4/2) + (6/3) = 2 + 2 = 4. 4 <= 2? NO.
// Real world: 2 rooms can hold 4 adults OR 6 children.
// Can 2 rooms hold 4 adults AND 6 children? No.
// So 4 is correct utilization.
