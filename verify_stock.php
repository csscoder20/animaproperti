<?php
try {
    // 1. Get or Create Properti
    $properti = \App\Models\Properti::first();
    if (!$properti) {
        $properti = \App\Models\Properti::create([
            'judul' => 'Test Property',
            'slug' => 'test-property-' . rand(),
            // add required fields.. assuming default factory exists or minimal create works
        ]);
    }
    echo "Using Properti ID: " . $properti->id . "\n";

    // 2. Get or Create TipeKamar via Relationship
    $tipe = $properti->tipeKamars()->first();
    if (!$tipe) {
        echo "Creating TipeKamar and Attaching...\n";
        // Create TipeKamar
        $tipe = \App\Models\TipeKamar::create([
            'nama' => 'Test Room Verification',
            'harga_per_malam' => 100000,
            'jumlah_kamar' => 5,
        ]);
        // Attach to Property
        $properti->tipeKamars()->attach($tipe->id, ['jumlah_kamar' => 5]); // Pivot data
    }
    echo "Using TipeKamar ID: " . $tipe->id . "\n";
    
    // 3. Get or Create Agent
    $agent = \App\Models\Agen::first();
    if (!$agent) {
        echo "Creating Agent...\n";
        $agent = \App\Models\Agen::create([
             'nama_lengkap' => 'Test Agent Verification',
             'no_hp' => '08999999999',
             'email' => 'agent_verify@test.com',
             'password' => bcrypt('password'),
        ]);
    }
    echo "Using Agent ID: " . $agent->id . "\n";

    echo "START_TEST\n";
    echo "Room: " . $tipe->nama . "\n";
    echo "Initial Stock: " . $tipe->jumlah_kamar . "\n";

    // Force stock to 5 for testing
    // Note: We are updating the TipeKamar directly as per controller logic, 
    // even though pivot exists. Controller modifies TipeKamar table.
    $tipe->jumlah_kamar = 5;
    $tipe->save();
    echo "Stock Reset to 5 for Test.\n";

    // Simulate Booking Process (Decorate count on TipeKamar)
    $tipe->decrement('jumlah_kamar');
    $afterBooking = $tipe->fresh()->jumlah_kamar;
    echo "Decremented (Simulated Booking) to: " . $afterBooking . "\n";

    // Create Booking Record
    echo "Creating Booking...\n";
    $booking = \App\Models\Booking::create([
        'properti_id' => $properti->id,
        'tipe_kamar_id' => $tipe->id,
        'agent_id' => $agent->id,
        'customer_name' => 'Test Stock',
        'customer_phone' => '08123456789',
        'nik' => '1234567890123456',
        'email' => 'test@example.com',
        'checkin' => now()->format('Y-m-d'),
        'checkout' => now()->addDay()->format('Y-m-d'),
        'rooms' => 1,
        'guests' => 1,
        'duration' => 1,
        'total_price' => 100000,
        'status' => 'confirmed',
        'payment_method' => 'Cash',
        // 'room_number' => '101' // Optional
    ]);

    echo "Booking Created with ID: " . $booking->id . "\n";

    // Delete Booking (Should trigger event to increment stock)
    $booking->delete();
    $final = $tipe->fresh()->jumlah_kamar;
    echo "Booking Deleted.\n";
    echo "Final Stock: " . $final . "\n";

    if ($final == 5) {
        echo "SUCCESS: Stock restored to 5.\n";
    } else {
        echo "FAILED: Stock NOT restored (Expected 5, Got $final).\n";
    }
    echo "END_TEST\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
