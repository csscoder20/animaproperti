
<?php

use App\Models\Properti;
use Illuminate\Support\Facades\DB;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- Simulating Capacity Logic ---\n";

// 1. Setup Data: Ensure we have test cases
// Case A: Legacy Property (kapasitas_tamu=2, others null/0)
// Case B: New Property (kapasitas_tamu=0, dewasa=2, anak=1)

$guests = 2;

$query = Properti::where(function ($q) use ($guests) {
    $q->where('kapasitas_tamu', '>=', $guests)
      ->orWhereRaw('(COALESCE(kapasitas_dewasa_per_kamar, 0) + COALESCE(kapasitas_anak_per_kamar, 0)) >= ?', [$guests]);
});

echo "Searching for Guests >= $guests\n";
$results = $query->get();
echo "Found " . $results->count() . " properties.\n";

foreach ($results as $r) {
    echo "- " . substr($r->judul, 0, 30) . "... | K_Tamu: " . $r->kapasitas_tamu . " | Dewasa: " . $r->kapasitas_dewasa_per_kamar . " | Anak: " . $r->kapasitas_anak_per_kamar . "\n";
}
