<?php

namespace App\Services;

use App\DTOs\BookingDataDTO;
use App\DTOs\SeatDTO;
use App\Enums\SeatTypeEnum;
use App\Enums\StatusEnum;
use App\Events\SeatReservationRequested;
use App\Factories\Pricing\SeatPricingStrategyFactory;
use App\Models\BookedSeat;
use App\Models\Booking;
use App\Models\Screening;
use App\Repositories\Contracts\IBookedSeatRepository;
use App\Repositories\Contracts\IBookingRepository;
use App\Repositories\Contracts\IScreeningRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Collection;

class BookingService
{
    public function __construct(
        protected IBookingRepository $bookingRepository,
        protected IBookedSeatRepository $bookedSeatRepository,
        protected IScreeningRepository $screeningRepository,

    )
    {}

    public function createBooking(array $data): Booking
    {
        $userId = request()->header('X-User-Id');
        $screening = $this->screeningRepository->findById($data['screening_id']);
        $basePrice = $screening->price;

        $seatDTOs = collect($data['seats'])
            ->map(fn(array $seatIds, string $seatType) => new SeatDTO(
                seatIds: $seatIds,
                type: SeatTypeEnum::from($seatType),
            ));

        $totalPrice = $seatDTOs->sum(function (SeatDTO $seat) use ($basePrice) {
            $strategy = SeatPricingStrategyFactory::make($seat->type);
            return $strategy->calculatePrice($basePrice, count($seat->seatIds));
        });

        $bookingDTO = new BookingDataDTO(
            userId: $userId,
            price: $totalPrice,
            status: StatusEnum::PENDING,
        );

        $booking = $this->bookingRepository->create($bookingDTO);

        $seatIds = collect($seatDTOs)
        ->flatMap(fn($seat) => $seat->seatIds)
        ->all();

        SeatReservationRequested::dispatch($booking->id, $data['screening_id'], $seatIds );

        return $booking;
    }

    public function getBookingsForUser(string $userId): Collection
    {
        return $this->bookingRepository->getByUserId($userId);
    }

    /**
     * @throws AuthorizationException
     */
    public function deleteBooking(string $bookingId, string $userId): bool
    {
        $booking = $this->bookingRepository->findById($bookingId);

        if ($booking->user_id != $userId) {
            throw new AuthorizationException('Not authorized to delete this booking');
        }

        return $this->bookingRepository->delete($booking);
    }

    public function confirmBooking(string $bookingId, array $seatIds): Booking
    {
        $booking = $this->bookingRepository->findById($bookingId);

        $this->bookedSeatRepository->createMany($booking->id, $seatIds);

        return $this->bookingRepository->markAsConfirmed($booking);
    }

    public function failBooking(string $bookingId): Booking
    {
        $booking = $this->bookingRepository->findById($bookingId);

        return $this->bookingRepository->markAsFailed($booking);
    }
}
