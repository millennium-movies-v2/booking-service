<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface IReservedSeatRepository
{
    public function getByScreeningId(string $screeningId): Collection;

    public function areSeatsAvailable(string $screeningId, array $seatIds): bool;
}
