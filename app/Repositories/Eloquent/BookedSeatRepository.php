<?php

namespace App\Repositories\Eloquent;

use App\Models\BookedSeat;
use App\Repositories\Contracts\IBookedSeatRepository;
use Illuminate\Support\Str;

class BookedSeatRepository implements IBookedSeatRepository
{
    /**
     * @param string $bookingId
     * @param int[] $seatIds
     */
    public function createMany(string $bookingId, array $seatIds): void
    {
        $insert = array_map(fn($seatId) => [
            'id'           => Str::uuid(),
            'booking_id'   => $bookingId,
            'seat_id'      => $seatId,
        ], $seatIds);

        BookedSeat::query()->insert($insert);
    }
}