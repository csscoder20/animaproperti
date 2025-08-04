<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PropertyImage extends Model
{

    use HasFactory, HasUuids;
    protected $table = 'property_images';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'properti_id',
        'path',
        'is_primary',
    ];

    /**
     * Relasi ke properti.
     */
    public function properti()
    {
        return $this->belongsTo(Properti::class);
    }

    /**
     * Accessor untuk URL gambar lengkap.
     */
    public function getUrlAttribute()
    {
        return asset('storage/' . $this->path);
    }
}
