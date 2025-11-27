<?php

namespace App\Services;

use App\DTOs\BookingDataDTO;
use App\DTOs\SeatDTO;
use App\Enums\SeatTypeEnum;
use App\Enums\StatusEnum;
use App\Factories\Pricing\SeatPricingStrategyFactory;
use App\Models\Booking;
use App\Repositories\Contracts\IBookingRepository;

class BookingService
{
    public function __construct(
        protected IBookingRepository $bookingRepository,
        )
    {}

    public function createBooking(array $data): Booking
    {
        $seatDTOs = array_map(fn($seat) => new SeatDTO(
            seatIds: $seat['seat_ids'],
            type: SeatTypeEnum::from($seat['pricing']['type']),
            unitPrice: $seat['pricing']['unit_price']
        ), $data['seats']);

        $totalPrice = collect($seatDTOs)->sum(function ($seat) {
            $strategy = SeatPricingStrategyFactory::make($seat->type);
            return $strategy->calculatePrice($seat);
        });

        $bookingDTO = new BookingDataDTO(
            userId: $data['user_id'],
            price: $totalPrice,
            status: StatusEnum::PENDING,
        );

        $booking = $this->bookingRepository->create($bookingDTO);

        return $booking;
    }
}