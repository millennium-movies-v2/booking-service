<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
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
        $userId = (string) request()->header('X-User-Id');

        $bookings = $this->bookingService->getBookingsForUser($userId);

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

    public function destroy(string $id)
    {
        $userId = (string) request()->header('X-User-Id');

        $booking = Booking::query()
                        ->findOrFail($id);

        if ($booking->user_id != $userId) return false;

        return $booking->delete();
    }
}
