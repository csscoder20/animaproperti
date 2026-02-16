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
        'disewa_per_kamar',
        'harga_sewa_per_malam',
        'tersedia_dari_kamar',
        'tersedia_sampai_kamar',
        'kapasitas_dewasa_per_kamar',
        'kapasitas_anak_per_kamar',
    ];

    public function jenisProperti()
    {
        return $this->belongsTo(JenisProperti::class);
    }

    public function lokasi()
    {
        return $this->belongsTo(MasterWilayah::class, 'kelurahan', 'kode');
    }

    public function fasilitas()
    {
        return $this->belongsToMany(Fasilitas::class, 'fasilitas_properti', 'properti_id', 'fasilitas_id')->withTimestamps();
    }

    public function agens()
    {
        return $this->belongsToMany(Agen::class, 'agen_properti');
    }

    public function tipeKamars()
    {
        return $this->belongsToMany(TipeKamar::class, 'properti_tipe_kamar', 'properti_id', 'tipe_kamar_id')
                    ->using(PropertiTipeKamar::class)
                    ->withPivot(['id', 'harga_per_malam', 'tersedia_dari', 'tersedia_sampai', 'kapasitas_dewasa', 'kapasitas_anak', 'jumlah_kamar', 'luas_kamar', 'tipe_bed', 'gambar'])
                    ->withTimestamps();
    }

    public function propertiTipeKamars()
    {
        return $this->hasMany(PropertiTipeKamar::class);
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

    public function updateRoomStats()
    {
        if ($this->disewa_per_kamar) {
            $tipeKamars = $this->tipeKamars()->get();
            
            $totalRooms = $tipeKamars->sum('jumlah_kamar');
            
            // Calculate total capacity (adults)
            $totalCapacity = $tipeKamars->sum(function ($item) {
                return (int)$item->kapasitas_dewasa * (int)$item->jumlah_kamar;
            });

            $this->update([
                'jumlah_kamar' => $totalRooms,
                'kapasitas_tamu' => $totalCapacity,
            ]);
        }
    }
}
