<?php

namespace App\Strategies\Pricing\Concrete;

use App\Strategies\Pricing\Contracts\ISeatPricingStrategy;
use App\DTOs\SeatDTO;

class VIPSeatPricingStrategy implements ISeatPricingStrategy
{
    public function calculatePrice(float $basePrice, int $count): float
    {
        $MULTIPLIER = 1.2;
        return $basePrice * $count * $MULTIPLIER;
    }
}