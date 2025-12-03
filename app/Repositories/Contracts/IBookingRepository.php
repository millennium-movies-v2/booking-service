<?php

namespace App\Repositories\Contracts;

use App\DTOs\BookingDataDTO;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Collection;

interface IBookingRepository
{
    public function create(BookingDataDTO $data): Booking;
    
    public function getByUserId(string $userId): Collection;
}