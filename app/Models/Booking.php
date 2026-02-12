<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Booking extends Model
{
    use HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    //
    protected $fillable = [
        'properti_id',
        'agent_id',
        'customer_name',
        'customer_phone',
        'checkin',
        'checkout',
        'rooms',
        'guests',
        'duration',
        'total_price',
        'status',
    ];

    public function properti()
    {
        return $this->belongsTo(Properti::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agen::class);
    }
}
