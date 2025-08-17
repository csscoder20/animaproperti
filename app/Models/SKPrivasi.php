<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SKPrivasi extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'sk_privasi';

    protected $fillable = [
        'judul',
        'kategori',
        'isi',
    ];
}
