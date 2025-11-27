<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use Illuminate\Http\JsonResponse;

class BookingController extends Controller
{
    public function store(StoreBookingRequest $request): JsonResponse
    {
        $response = [
            'booking_id' => 'booking_id',
            'status' => 'status',
        ];

        return response()->json($response, 201);
    }

}
