<?php

namespace App\Repositories\Contracts;

use App\DTOs\SeatDTO;

interface IBookedSeatRepository
{
    /**
     * @param string $bookingId
     * @param int[] $seatIds
     */
    public function createMany(string $bookingId, array $seatIds);
}