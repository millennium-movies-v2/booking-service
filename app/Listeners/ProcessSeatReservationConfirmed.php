<?php

namespace App\Listeners;

use App\Events\SeatReservationConfirmed;
use App\Repositories\Contracts\IBookedSeatRepository;
use App\Repositories\Contracts\IBookingRepository;
use App\Services\BookingService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProcessSeatReservationConfirmed
{
    /**
     * Create the event listener.
     */
    public function __construct(
        protected BookingService $bookingService,
    )
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SeatReservationConfirmed $event): void
    {
        $this->bookingService->confirmBooking($event->bookingId, $event->seatIds);
    }
}
