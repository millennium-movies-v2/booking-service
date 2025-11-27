<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use App\Models\Status;
use Illuminate\Http\JsonResponse;

class BookingController extends Controller
{

    public function store(StoreBookingRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $status = Status::query()->firstOrCreate([
            'name' => 'pending',
        ]);
        
        $price = 0;

        $booking = Booking::query()->create([
            'user_id'      => $validated['user_id'],
            'price' => $price,
            'status_id'    => $status->id,
        ]);

        $response = [
            'booking_id' => $booking->id,
            'status'     => $booking->status->name,
        ];

        return response()->json($response, 201);
    }


}
