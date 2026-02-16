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

    protected $fillable = [
        'id',
        'nama',
        'harga_per_malam',
        'jumlah_kamar',
        'kapasitas_dewasa',
        'kapasitas_anak',
        'tersedia_dari',
        'tersedia_sampai',
        'luas_kamar',
        'tipe_bed',
        'gambar',
    ];

    public function propertis()
    {
        return $this->belongsToMany(Properti::class, 'properti_tipe_kamar', 'tipe_kamar_id', 'properti_id');
    }

    public function fasilitas()
    {
        return $this->belongsToMany(Fasilitas::class, 'fasilitas_tipe_kamar', 'tipe_kamar_id', 'fasilitas_id')->withTimestamps();
    }
}
