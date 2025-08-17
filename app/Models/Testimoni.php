<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Testimoni extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'testimonis';

    protected $fillable = [
        'nama',
        'jabatan',
        'pesan',
        'is_active',
    ];
}
