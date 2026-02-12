<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penyewaan extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'penyewaans';

    protected $fillable = [
        'properti_id',
        'pelanggan_id',
        'nama_penyewaan',
        'check_in',
        'check_out',
        'jumlah_kamar',
        'jumlah_tamu',
        'harga_per_kamar',
        'lama_sewa',
        'harga_total',
        'pembayaran',
        'status_pembayaran',
        'nilai_dp',
        'tanggal_transaksi',
        'catatan',
    ];

    public function properti(): BelongsTo
    {
        return $this->belongsTo(Properti::class);
    }

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class);
    }
}
