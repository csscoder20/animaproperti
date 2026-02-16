<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "Creating tables manually...\n";

    if (!Schema::hasTable('tipe_kamars')) {
        Schema::create('tipe_kamars', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama');
            $table->timestamps();
        });
        echo "Table 'tipe_kamars' created.\n";
    }

    if (!Schema::hasTable('properti_tipe_kamar')) {
        Schema::create('properti_tipe_kamar', function (Blueprint $table) {
            $table->foreignUuid('properti_id')->constrained('propertis')->cascadeOnDelete();
            $table->foreignUuid('tipe_kamar_id')->constrained('tipe_kamars')->cascadeOnDelete();
            $table->primary(['properti_id', 'tipe_kamar_id']);
        });
        echo "Table 'properti_tipe_kamar' created.\n";
    }

    echo "Manual creation complete.\n";

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
