<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReservedSeatResource;
use App\Models\ReservedSeat;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ScreeningReservedSeatController extends Controller
{
    public function index(string $id): AnonymousResourceCollection
    {
        $bookedSeats = ReservedSeat::query()
            ->where(['screeening_id' => $id])
            ->get();

        return ReservedSeatResource::collection($bookedSeats);
    }
}
