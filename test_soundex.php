<?php

use Illuminate\Support\Facades\DB;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$keyword1 = 'Makasar';
$keyword2 = 'Makassar';

try {
    $results = DB::select("SELECT SOUNDEX(?) as s1, SOUNDEX(?) as s2", [$keyword1, $keyword2]);
    print_r($results);

    $match = $results[0]->s1 === $results[0]->s2;
    echo "Match: " . ($match ? "YES" : "NO") . "\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
