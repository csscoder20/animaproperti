<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Properti extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $table = 'propertis';

    protected $fillable = [
        'id',
        'agen_id',
        'judul',
        'slug',
        'deskripsi',
        'harga',
        'status',
        'penawaran',
        'kode_pos',
        'alamat_lengkap',
        'gbr_primary_properti',
        'link_brosur',
        'link_site_plan',
        'link_spesifikasi',
        'link_layout',
        'jumlah_kamar_tidur',
        'jumlah_kamar_mandi',
        'luas_bangunan',
        'luas_tanah',
        'tahun_dibangun',
        'unggulan',
        'jenis_cluster',
        'tipe_perumahan',
        'jenis_properti_id',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'jumlah_kamar',
        'kapasitas_tamu',
        'tersedia_dari',
        'tersedia_sampai',
    ];

    public function jenisProperti()
    {
        return $this->belongsTo(JenisProperti::class);
    }

    public function lokasi()
    {
        return $this->belongsTo(MasterWilayah::class, 'kelurahan', 'kode');
    }

    public function agens()
    {
        return $this->belongsToMany(Agen::class, 'agen_properti');
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function getPrimaryImageUrlAttribute()
    {
        return $this->gbr_primary_properti
            ? asset('storage/' . $this->gbr_primary_properti)
            : asset('themes/frontend/assets/img/default.png');
    }
}
