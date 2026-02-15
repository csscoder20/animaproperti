
<?php

use App\Models\Properti;
use App\Models\JenisProperti;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- Jenis Properti List ---\n";
$types = JenisProperti::all();
foreach ($types as $t) {
    echo "ID: {$t->id} | Nama: {$t->nama} | Slug: {$t->slug}\n";
}

echo "\n--- Apartemen Property Check ---\n";
// Find properties with 'Apartemen' in the title to see what they are linked to
$props = Properti::where('judul', 'LIKE', '%Apartemen%')->get();
foreach ($props as $p) {
    echo "Judul: {$p->judul}\n";
    echo "Jenis Prop ID: {$p->jenis_properti_id}\n";
    $jenis = JenisProperti::find($p->jenis_properti_id);
    echo "Linked Jenis Nama: " . ($jenis ? $jenis->nama : 'NULL') . "\n";
    echo "Linked Jenis Slug: " . ($jenis ? $jenis->slug : 'NULL') . "\n";
    echo "--------------------------\n";
}
