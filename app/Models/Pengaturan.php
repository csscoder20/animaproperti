<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Pengaturan extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'pengaturans';

    public $incrementing = false;
    protected $keyType = 'string';


    protected $fillable = [
        'key',
        'value',
    ];

    /**
     * Ambil nilai pengaturan berdasarkan key.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */

    public static function ambil(string $key, $default = null)
    {
        $pengaturan = static::where('key', $key)->first();

        return $pengaturan ? $pengaturan->nilai : $default;
    }

    public static function getAllAsArray(): array
    {
        return static::all()->pluck('value', 'key')->toArray();
    }

    public static function setBulk(array $data): void
    {
        foreach ($data as $key => $value) {
            static::setValue($key, $value);
        }
    }

    public static function getValue(string $key, mixed $default = null): mixed
    {
        return static::where('key', $key)->value('value') ?? $default;
    }

    public static function setValue(string $key, mixed $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
