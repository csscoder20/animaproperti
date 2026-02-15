
<?php

use App\Models\Properti;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- Inspecting Apartemen Capacity ---\n";
// Find the "Apartemen" property
$prop = Properti::whereHas('jenisProperti', function($q) {
    $q->where('slug', 'apartemen');
})->first();

if ($prop) {
    echo "Judul: " . $prop->judul . "\n";
    echo "Jumlah Kamar: " . $prop->jumlah_kamar . "\n";
    echo "Kapasitas Tamu: " . $prop->kapasitas_tamu . "\n";
} else {
    echo "Apartemen property not found.\n";
}
