<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class Announcement extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'announcements';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'title',
        'content',
        'image',
        'type',
        'is_active',
        'start_date',
        'end_date',
        'show_once_per_session'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'show_once_per_session' => 'boolean'
    ];
}
