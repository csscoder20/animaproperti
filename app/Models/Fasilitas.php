<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'fasilitas';
    protected $guarded = ['id'];

    public function properti()
    {
        return $this->belongsToMany(Properti::class, 'fasilitas_properti', 'fasilitas_id', 'properti_id');
    }
}
