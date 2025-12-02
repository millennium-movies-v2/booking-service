<?php

namespace App\Models;

use Database\Factories\ReservedSeatFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class ReservedSeat extends Model
{
    /** @use HasFactory<ReservedSeatFactory> */
    use HasFactory;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'screening_id',
        'seat_id',
    ];

    protected $casts = [
        'price' => 'float',
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function screening(): BelongsTo
    {
        return $this->belongsTo(Screening::class);
    }
}
