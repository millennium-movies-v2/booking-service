<?php

namespace App\Factories\Pricing;

use App\Enums\SeatTypeEnum;
use App\Strategies\Pricing\Concrete\RegularSeatPricingStrategy;
use App\Strategies\Pricing\Concrete\VIPSeatPricingStrategy;
use App\Strategies\Pricing\Contracts\ISeatPricingStrategy;

class SeatPricingStrategyFactory
{
    public static function make(SeatTypeEnum $type): ISeatPricingStrategy
    {
        return match($type) {
            SeatTypeEnum::VIP => new VIPSeatPricingStrategy(),
            SeatTypeEnum::REGULAR => new RegularSeatPricingStrategy(),
        };
    }
}
