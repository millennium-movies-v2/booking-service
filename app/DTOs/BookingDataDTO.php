<?php

namespace App\DTOs;

use App\Enums\StatusEnum;

class BookingDataDTO
{
    public function __construct(
        public string $userId,
        public float $price,
        public StatusEnum $status
    ) {}
}
