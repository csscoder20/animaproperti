<?php

use Illuminate\Support\Facades\DB;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$keyword = 'Makasar'; // User input
$dbName = 'Kota Makassar'; // DB value

// Simulate SQL
// We want to see if SOUNDEX(REPLACE(dbName, 'Kota ', '')) matches SOUNDEX(keyword)

try {
    // Note: SQLite might not support REPLACE in the same way, or SOUNDEX might behave differently.
    // But we are using the project's DB connection (likely MySQL/MariaDB).

    $query = "
        SELECT 
            SOUNDEX(?) as keyword_sound,
            SOUNDEX(?) as db_sound,
            SOUNDEX(REPLACE(?, 'Kota ', '')) as stripped_sound,
            (SOUNDEX(?) = SOUNDEX(REPLACE(?, 'Kota ', ''))) as match_stripped
    ";

    $results = DB::select($query, [$keyword, $dbName, $dbName, $keyword, $dbName]);
    print_r($results);

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
