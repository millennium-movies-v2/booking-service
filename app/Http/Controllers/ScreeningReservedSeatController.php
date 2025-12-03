<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReservedSeatResource;
use App\Services\ReservedSeatService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ScreeningReservedSeatController extends Controller
{
    public function __construct(
        protected ReservedSeatService $reservedSeatService,
    )
    {}

    public function index(string $id): AnonymousResourceCollection
    {
        $reservedSeats = $this->reservedSeatService->getReservedSeatsByScreening($id);

        return ReservedSeatResource::collection($reservedSeats);
    }
}
