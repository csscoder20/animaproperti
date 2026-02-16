<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PropertiTipeKamar extends Pivot
{
    use HasFactory, HasUuids;

    public $incrementing = true; // Since we added an ID column
    protected $keyType = 'string'; // UUID

    protected $table = 'properti_tipe_kamar';

    protected $fillable = [
        'properti_id',
        'tipe_kamar_id',
        'harga_per_malam',
        'tersedia_dari',
        'tersedia_sampai',
        'kapasitas_dewasa',
        'kapasitas_anak',
        'jumlah_kamar',
        'luas_kamar',
        'tipe_bed',
        'gambar',
    ];

    protected static function booted()
    {
        static::saved(function ($model) {
            $model->properti->updateRoomStats();
        });

        static::deleted(function ($model) {
            $model->properti->updateRoomStats();
        });
    }

    public function properti()
    {
        return $this->belongsTo(Properti::class);
    }

    public function tipeKamar()
    {
        return $this->belongsTo(TipeKamar::class);
    }
}
