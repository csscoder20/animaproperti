<?php
$slug = \App\Models\Properti::first()->slug; // Get any property slug
$controller = new \App\Http\Controllers\SewaController();
// Simulate show method logic manually
$property = \App\Models\Properti::with(['tipeKamars' => function($q) {
    $q->where('tipe_kamars.jumlah_kamar', '>', 0)->with('fasilitas');
}, 'fasilitas'])->where('slug', $slug)->first();

echo "Property: " . $property->judul . "\n";
echo "Direct Facilities: " . $property->fasilitas->count() . "\n";
echo "Room Types: " . $property->tipeKamars->count() . "\n";

$roomFacilities = $property->tipeKamars->pluck('fasilitas')->flatten();
echo "Room Facilities Total: " . $roomFacilities->count() . "\n";

$allFacilities = $property->fasilitas->merge($roomFacilities)->unique('id');
echo "Merged Unique Facilities: " . $allFacilities->count() . "\n";

if ($allFacilities->count() > 0) {
    echo "SUCCESS: Facilities found.\n";
    foreach($allFacilities as $f) {
        echo "- " . $f->nama . "\n";
    }
} else {
    echo "WARNING: No facilities found even after merge.\n";
}
