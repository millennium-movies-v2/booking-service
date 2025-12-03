<?php

namespace App\Services;


use App\Events\SeatReservationConfirmed;
use App\Events\SeatReservationFailed;
use App\Repositories\Contracts\IReservedSeatRepository;

class SeatReservationService
{
    public function __construct(
        protected IReservedSeatRepository $reservedSeatRepository
    ) {}

    public function process(string $bookingId, string $screeningId, array $seatIds): void
    {
        $available = $this->reservedSeatRepository->areSeatsAvailable($screeningId, $seatIds);

        if ($available) {
            SeatReservationConfirmed::dispatch();
        } else {
            SeatReservationFailed::dispatch();
        }
    }
}
