<?php

namespace App\Strategies\Pricing\Contracts;

use App\DTOs\SeatDTO;

interface ISeatPricingStrategy
{
    public function calculatePrice(SeatDTO $seat): float;
}