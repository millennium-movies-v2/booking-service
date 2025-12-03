<?php

namespace App\Listeners;

use App\Events\SeatReservationRequested;
use App\Services\SeatReservationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProcessSeatReservationRequested
{
    /**
     * Create the event listener.
     */
    public function __construct(
        protected SeatReservationService $seatReservationService
        )
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SeatReservationRequested $event): void
    {
        $this->seatReservationService->process($event->bookingId, $event->screeningId, $event->seatIds);
    }
}
