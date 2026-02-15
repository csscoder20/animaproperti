
<?php

use App\Models\Properti;
use Illuminate\Http\Request;
use App\Http\Controllers\SewaController;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- Simulating Search 'apartemen' with Guests=2 ---\n";

// Manual Query Construction to mimic Controller
$keyword = 'apartemen';
$guests = 2; // User's input

$query = Properti::with(['jenisProperti'])
    ->where('penawaran', 'Disewa')
    ->whereHas('jenisProperti', function ($q) {
        $q->whereIn('slug', ['kost', 'apartemen']);
    });

// Apply Keyword Logic
$query->where(function ($q) use ($keyword) {
   $q->where('judul', 'LIKE', '%' . $keyword . '%')
     ->orWhereHas('jenisProperti', function ($qType) use ($keyword) {
          $qType->where('nama', 'LIKE', '%' . $keyword . '%');
     });
});

// Apply Guest Filter
echo "Applying Guests >= $guests filter...\n";
$query->where('kapasitas_tamu', '>=', $guests);

$count = $query->count();
echo "Results Found: $count\n";

if ($count == 0) {
    echo "\n--- Retrying with Guests=1 ---\n";
    $query2 = Properti::with(['jenisProperti', 'agens'])
        ->where('penawaran', 'Disewa')
        ->whereHas('jenisProperti', function ($q) {
            $q->whereIn('slug', ['kost', 'apartemen']);
        });
        
    $query2->where(function ($q) use ($keyword) {
       $q->where('judul', 'LIKE', '%' . $keyword . '%')
         ->orWhereHas('jenisProperti', function ($qType) use ($keyword) {
              $qType->where('nama', 'LIKE', '%' . $keyword . '%');
         });
    });

    $query2->where('kapasitas_tamu', '>=', 1);
    
    $results = $query2->get();
    echo "Results Found with Guests=1: " . $results->count() . "\n";
    foreach($results as $r) {
        echo "Found: " . $r->judul . " (Capacity: " . $r->kapasitas_tamu . ")\n";
    }
}
