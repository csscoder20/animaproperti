<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class TipeKamar extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = ['id'];

    public function propertis()
    {
        return $this->belongsToMany(Properti::class, 'properti_tipe_kamar', 'tipe_kamar_id', 'properti_id');
    }
}
