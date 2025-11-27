<?php

namespace App\Models;

use Database\Factories\BookedSeatFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * @property string $id
 * @property string $booking_id
 * @property string $seat_id
 */
class BookedSeat extends Model
{
    /** @use HasFactory<BookedSeatFactory> */
    use HasFactory;

    protected $keyType = 'string';

    public $incrementing = false;
    
    protected $fillable = [
        'booking_id',
        'seat_id',
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}
