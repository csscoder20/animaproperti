
<?php

use App\Models\Properti;
use App\Models\MasterWilayah;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- Property Data Check ---\n";
// Find the "Apartemen" property
$prop = Properti::whereHas('jenisProperti', function($q) {
    $q->where('slug', 'apartemen');
})->first();

if ($prop) {
    echo "Judul: " . $prop->judul . "\n";
    echo "Alamat Lengkap: " . $prop->alamat_lengkap . "\n";
    echo "Kecamatan Code: " . $prop->kecamatan . "\n";
    echo "Kabupaten Code: " . $prop->kabupaten . "\n";
    echo "Provinsi Code: " . $prop->provinsi . "\n";

    // Check MasterWilayah for these codes
    $kec = MasterWilayah::where('kode', $prop->kecamatan)->first();
    echo "Kecamatan Name: " . ($kec ? $kec->nama : 'NOT FOUND') . "\n";
    
    $kab = MasterWilayah::where('kode', $prop->kabupaten)->first();
    echo "Kabupaten Name: " . ($kab ? $kab->nama : 'NOT FOUND') . "\n";
} else {
    echo "Apartemen property not found.\n";
}

echo "\n--- MasterWilayah Search Check ('makasar') ---\n";
$keyword = 'makasar';
$matching = MasterWilayah::where(function ($q) use ($keyword) {
    $q->where('nama', 'LIKE', '%' . $keyword . '%')
      ->orWhereRaw('SOUNDEX(nama) = SOUNDEX(?)', [$keyword])
      ->orWhereRaw("SOUNDEX(REPLACE(nama, 'Kota ', '')) = SOUNDEX(?)", [$keyword]);
})->pluck('kode', 'nama')->toArray();

echo "Found " . count($matching) . " matching codes.\n";
print_r($matching);
