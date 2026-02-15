
<?php

use App\Models\Properti;
use App\Models\MasterWilayah;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- Inspecting 'Rumah Secondary' Results ---\n";
$props = Properti::where('judul', 'LIKE', '%Rumah Secondary%')->get();

foreach ($props as $p) {
    echo "ID: " . $p->id . "\n";
    echo "Judul: " . $p->judul . "\n";
    echo "Alamat: " . $p->alamat_lengkap . "\n";
    echo "Kecamatan: " . $p->kecamatan . "\n";
    echo "Kabupaten: " . $p->kabupaten . "\n";
    
    // Check if "makasar" is in address?
    if (stripos($p->alamat_lengkap, 'makasar') !== false) {
        echo "MATCH: 'makasar' found in Address.\n";
    } else {
        echo "NO MATCH in Address text.\n";
    }
    
    // Check MasterWilayah for its location
    $kec = MasterWilayah::where('kode', $p->kecamatan)->first();
    echo "Kecamatan Name: " . ($kec ? $kec->nama : 'N/A') . "\n";
    
    $kab = MasterWilayah::where('kode', $p->kabupaten)->first();
    echo "Kabupaten Name: " . ($kab ? $kab->nama : 'N/A') . "\n";
    
    echo "--------------------------\n";
}
