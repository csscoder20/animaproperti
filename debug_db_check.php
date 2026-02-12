<?php

use Illuminate\Support\Facades\DB;

// Load Laravel
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Listing ALL Properties in Database:\n";
$props = DB::table('propertis')->pluck('id');

foreach ($props as $id) {
    echo "- $id\n";
}
echo "Total: " . count($props) . "\n";
