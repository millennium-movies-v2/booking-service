<?php

namespace App\DTOs;

use App\Enums\SeatTypeEnum;

class SeatDTO
{
    public function __construct(
        public array $seatIds,
        public SeatTypeEnum $type,
    ) {}
}

