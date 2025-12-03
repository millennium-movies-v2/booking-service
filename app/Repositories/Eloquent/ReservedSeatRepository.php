<?php

namespace App\Repositories\Eloquent;

use App\Models\ReservedSeat;
use App\Repositories\Contracts\IReservedSeatRepository;
use Illuminate\Database\Eloquent\Collection;

class ReservedSeatRepository implements IReservedSeatRepository
{
    public function getByScreeningId(string $screeningId): Collection
    {
        return ReservedSeat::query()
            ->where(['screening_id' => $screeningId])
            ->get();
    }

    public function areSeatsAvailable(string $screeningId, array $seatIds): bool
    {
        if (empty($seatIds)) {
            return false;
        }

        $anyReserved = ReservedSeat::query()
            ->whereIn('seat_id', $seatIds)
            ->where('screening_id', $screeningId)
            ->exists();

        return !$anyReserved;
    }
}