<?php

namespace App\Models;

use Database\Factories\ScreeningFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Screening extends Model
{
    /** @use HasFactory<ScreeningFactory> */
    use HasFactory;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'movie_id',
        'auditorium_id',
        'start_time',
        'price',
    ];

    protected $casts = [
        'start_time' => 'datetime:H:i:s',
        'price' => 'float',
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}
