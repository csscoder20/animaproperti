<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Slider extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'sliders';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'title',
        'image_path',
        'link_url',
        'order',
        'is_active',
        'is_temporary',
        'show_on_home',
        'show_on_sewa',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_temporary' => 'boolean',
        'show_on_home' => 'boolean',
        'show_on_sewa' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    /**
     * Scope untuk hanya slider yang aktif & sesuai jadwal tayang
     */
    public function scopeActive($query)
    {
        $now = Carbon::now();

        return $query->where('is_active', true)
            ->where(function ($q) use ($now) {
                // Jika temporary, cek tanggal. Jika tidak, abaikan tanggal.
                $q->where('is_temporary', false)
                  ->orWhere(function ($sub) use ($now) {
                      $sub->where('is_temporary', true)
                          ->where(function ($d) use ($now) {
                              $d->whereNull('start_date')->orWhere('start_date', '<=', $now);
                          })
                          ->where(function ($d) use ($now) {
                              $d->whereNull('end_date')->orWhere('end_date', '>=', $now);
                          });
                  });
            });
    }
}
