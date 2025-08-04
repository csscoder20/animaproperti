<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penjualan extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'penjualans';

    protected $fillable = [
        'properti_id',
        'pelanggan_id',
        'telepon',
        'email',
        'npwp',
        'foto_ktp',
        'foto_npwp',
        'alamat',
        'kode_pos',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'jenis_cluster',
        'tipe_perumahan',
        'jumlah_kamar_tidur',
        'jumlah_kamar_mandi',
        'luas_bangunan',
        'luas_tanah',
        'tanggal_penjualan',
        'harga',
        'harga_jual',
        'metode_pembayaran',
        'status_pembayaran',
        'catatan',
        'dokumen_pendukung',
    ];

    public function properti(): BelongsTo
    {
        return $this->belongsTo(Properti::class);
    }

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    public function lokasi()
    {
        return $this->belongsTo(MasterWilayah::class, 'kelurahan', 'kode');
    }
}
