
<?php

use App\Models\Properti;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- Inspecting 'Rumah Secondary' Capacity ---\n";
$props = Properti::where('judul', 'LIKE', '%Rumah Secondary%')->get();

foreach ($props as $p) {
    echo "ID: " . $p->id . "\n";
    echo "Judul: " . $p->judul . "\n";
    echo "Kapasitas Tamu: " . ($p->kapasitas_tamu ?? 'NULL') . "\n";
    echo "--------------------------\n";
}
