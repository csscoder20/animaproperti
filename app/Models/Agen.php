<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Agen extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'agens';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nama_lengkap',
        'gender',
        'birth_city',
        'birth_date',
        'no_hp',
        'email',
        'social_media',
        'social_media_id',
        'alamat_lengkap',
        'kode_pos',
        'pendidikan',
        'nama_sekolah',
        'tahun_lulus',
        'nilai_ipk',
        'sertifikat_kompetensi',
        'nama_perusahaan',
        'tahun_masuk',
        'tahun_keluar',
        'alasan_keluar',
        'pas_foto',
        'ktp',
        'cv',
        'kartu_nama',
        'perjanjian',
        'status',
    ];


    public function propertis()
    {
        return $this->belongsToMany(Properti::class, 'agen_properti', 'agen_id', 'properti_id');
    }
}
