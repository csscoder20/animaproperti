<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Pelanggan extends Model
{

    use HasFactory, HasUuids;

    protected $table = 'pelanggans';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'no_ktp',
        'telepon',
        'email',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'pekerjaan',
        'status_perkawinan',
        'tipe',
        'npwp',
        'foto_ktp',
        'foto_npwp',
    ];

    public function penjualans(): HasMany
    {
        return $this->hasMany(Penjualan::class, 'pelanggan_id');
    }
}
