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
}