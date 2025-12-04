<?php

namespace App\Listeners;

use App\Events\SeatReservationFailed;
use App\Services\BookingService;

class ProcessSeatReservationFailed
{
    /**
     * Create the event listener.
     */
    public function __construct(
        protected BookingService $bookingService,
    )
    {}

    /**
     * Handle the event.
     */
    public function handle(SeatReservationFailed $event): void
    {
        $this->bookingService->failBooking($event->bookingId);
    }
}
