<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Resources\BookingResource;
use App\Services\BookingService;
use Illuminate\Auth\Access\AuthorizationException;
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

    public function destroy(string $id): JsonResponse
    {
        $userId = (string) request()->header('X-User-Id');

        try {
            $isDeleted = $this->bookingService->deleteBooking($id, $userId);

            return response()->json([
                'message' => $isDeleted ? 'Booking deleted successfully' : 'Failed to delete booking',
            ]);

        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 403);
        }
    }
}
