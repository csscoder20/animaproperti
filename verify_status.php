<?php
try {
    // 1. Get Room
    $tipe = \App\Models\TipeKamar::first();
    if (!$tipe) { echo "No room found.\n"; exit; }
    
    // Reset Stock
    $tipe->jumlah_kamar = 5;
    $tipe->save();
    echo "Initial Stock: " . $tipe->jumlah_kamar . "\n";

    // 2. Create Booking (Pending)
    // Stock should decrement
    $tipe->decrement('jumlah_kamar'); // Simulate controller action
    echo "Stock after Booking Creation (Pending): " . $tipe->fresh()->jumlah_kamar . "\n";

    $booking = \App\Models\Booking::create([
        'properti_id' => $tipe->properti_id,
        'tipe_kamar_id' => $tipe->id,
        'agent_id' => \App\Models\Agen::first()->id,
        'customer_name' => 'Status Test',
        'customer_phone' => '08123456789',
        'checkin' => now()->format('Y-m-d'),
        'checkout' => now()->addDay()->format('Y-m-d'),
        'rooms' => 1,
        'guests' => 1,
        'duration' => 1,
        'total_price' => 100000,
        'status' => 'pending',
        'payment_method' => 'Cash',
    ]);

    // 3. Update Status to Confirmed (Stock should stay same)
    $booking->update(['status' => 'confirmed']);
    echo "Stock after Confirmed: " . $tipe->fresh()->jumlah_kamar . "\n";

    // 4. Update Status to Cancelled (Stock should increment)
    $booking->update(['status' => 'cancelled']);
    echo "Stock after Cancelled: " . $tipe->fresh()->jumlah_kamar . "\n";

    // 5. Update Status back to Pending (Stock should decrement)
    $booking->update(['status' => 'pending']);
    echo "Stock after Back to Pending: " . $tipe->fresh()->jumlah_kamar . "\n";

} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
