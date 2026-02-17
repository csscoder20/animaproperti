<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Booking extends Model
{
    use HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected static function booted()
    {
        // 1. Restore stock when Booking is DELETED
        static::deleted(function ($booking) {
            if ($booking->tipe_kamar_id) {
                $tipeKamar = \App\Models\TipeKamar::find($booking->tipe_kamar_id);
                if ($tipeKamar) {
                    $tipeKamar->increment('jumlah_kamar');
                }
            }
        });

        // 2. Adjust stock when Booking STATUS is UPDATED
        static::updated(function ($booking) {
            if ($booking->isDirty('status')) {
                $oldStatus = $booking->getOriginal('status');
                $newStatus = $booking->status;

                // Define status groups
                // Stock Decreasing Statuses (Stock Occupied)
                $activeStatuses = ['pending', 'confirmed', 'paid', 'completed'];
                
                // Stock Restoring Statuses (Stock Free)
                $inactiveStatuses = ['cancelled', 'refunded'];

                // Check transition
                $wasActive = in_array($oldStatus, $activeStatuses);
                $isInactive = in_array($newStatus, $inactiveStatuses);

                $wasInactive = in_array($oldStatus, $inactiveStatuses);
                $isActive = in_array($newStatus, $activeStatuses);

                if ($booking->tipe_kamar_id) {
                    $tipeKamar = \App\Models\TipeKamar::find($booking->tipe_kamar_id);
                    if ($tipeKamar) {
                        // Case A: Active -> Inactive (e.g. Confirmed -> Cancelled)
                        // RESTORE Stock
                        if ($wasActive && $isInactive) {
                             $tipeKamar->increment('jumlah_kamar', $booking->rooms ?? 1);
                        }

                        // Case B: Inactive -> Active (e.g. Cancelled -> Pending)
                        // REDUCE Stock
                        if ($wasInactive && $isActive) {
                             $tipeKamar->decrement('jumlah_kamar', $booking->rooms ?? 1);
                        }
                    }
                }
            }
        });
    }

    //
    protected $fillable = [
        'properti_id',
        'agent_id',
        'customer_name',
        'customer_phone',
        'nik',
        'email',
        'checkin',
        'checkout',
        'rooms',
        'guests',
        'duration',
        'total_price',
        'status',
        'payment_method',
        'room_number',
        'tipe_kamar_id',
    ];

    public function properti()
    {
        return $this->belongsTo(Properti::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agen::class);
    }

    public function tipeKamar()
    {
        return $this->belongsTo(TipeKamar::class);
    }
}
