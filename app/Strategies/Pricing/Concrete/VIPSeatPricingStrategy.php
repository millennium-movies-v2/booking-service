<?php

namespace App\Strategies\Pricing\Concrete;

use App\Strategies\Pricing\Contracts\ISeatPricingStrategy;
use App\DTOs\SeatDTO;

class VIPSeatPricingStrategy implements ISeatPricingStrategy
{
    public function calculatePrice(SeatDTO $seat): float
    {
        $MULTIPLIER = 1.2;
        return $seat->unitPrice * count($seat->seatIds) * $MULTIPLIER;
    }
}