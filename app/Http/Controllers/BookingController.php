<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Models\Status;
use App\Services\BookingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BookingController extends Controller
{
    public function __construct(
        protected BookingService $bookingService,
        )
    {}

    public function index(): AnonymousResourceCollection
    {
        $userId = request()->header('X-User-Id');

        $bookings = Booking::query()
                        ->with('status')
                        ->where(['user_id' => $userId])
                        ->get();

        return BookingResource::collection($bookings);

    }

    public function store(StoreBookingRequest $request): JsonResponse
    {
        $booking = $this->bookingService->createBooking($request->validated());

        $response = [
            'booking_id' => $booking->id,
            'status'     => $booking->status->name,
        ];

        return response()->json($response, 201);
    }


}
