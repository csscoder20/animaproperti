<?php

use App\Models\Properti;
use App\Models\MasterWilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Mock Request
$request = new Request();
$request->merge(['keyword' => 'Jakarta']);

// Replicate Logic from Controller
$query = Properti::with(['jenisProperti', 'agens'])
    ->where('penawaran', 'Disewa')
    // Existing base filter
    ->whereHas('jenisProperti', function ($q) {
        $q->whereIn('slug', ['kost', 'apartemen']);
    });

if ($request->filled('keyword')) {
    $keyword = $request->keyword;

    // 1. Cari kode wilayah yang namanya cocok dengan keyword
    // Mocking the behavior since we might not have DB connection in this raw script without booting everything, 
    // but running it via 'php artisan tinker' or route is better. 
    // We'll write this file as a route addition to web.php temporarily.
}
