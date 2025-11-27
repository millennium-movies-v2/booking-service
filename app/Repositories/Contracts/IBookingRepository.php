<?php

namespace App\Repositories\Contracts;

use App\DTOs\BookingDataDTO;
use App\Models\Booking;

interface IBookingRepository
{
    public function create(BookingDataDTO $data): Booking;
}