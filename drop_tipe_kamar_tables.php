<?php

use Illuminate\Support\Facades\Schema;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "Dropping tables...\n";
    Schema::dropIfExists('properti_tipe_kamar');
    Schema::dropIfExists('tipe_kamars');
    echo "Tables dropped.\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
