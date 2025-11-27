<?php

namespace App\DTOs;

use App\Enums\StatusEnum;

class BookingDTO
{
    public function __construct(
        public string $id,
        public string $userId,
        public float $price,
        public StatusEnum $status
    ) {}
}