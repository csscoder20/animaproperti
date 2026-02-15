
<?php

use Illuminate\Support\Facades\Schema;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- Propertis Table Columns ---\n";
$columns = Schema::getColumnListing('propertis');
foreach ($columns as $col) {
    if (strpos($col, 'kapasitas') !== false || strpos($col, 'tamu') !== false) {
        echo "- $col\n";
    }
}
