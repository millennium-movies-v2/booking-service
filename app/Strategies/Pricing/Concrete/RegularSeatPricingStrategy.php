<?php

namespace App\Strategies\Pricing\Concrete;

use App\Strategies\Pricing\Contracts\ISeatPricingStrategy;
use App\DTOs\SeatDTO;

class RegularSeatPricingStrategy implements ISeatPricingStrategy
{
    public function calculatePrice(SeatDTO $seat): float
    {
        return $seat->unitPrice * count($seat->seatIds);
    }
}
