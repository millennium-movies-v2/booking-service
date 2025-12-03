<?php

namespace App\Services;

use App\Repositories\Eloquent\ReservedSeatRepository;
use Illuminate\Database\Eloquent\Collection;

class ReservedSeatService
{
    public function __construct(
        protected ReservedSeatRepository $reservedSeatRepository,
    )
    {}

    public function getReservedSeatsByScreening(string $screeningId): Collection
    {
        return $this->reservedSeatRepository->getByScreeningId($screeningId);
    }
}
