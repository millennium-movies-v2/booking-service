<?php

namespace App\Listeners;

use App\Events\SeatReservationRequested;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProcessSeatReservationRequested
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SeatReservationRequested $event): void
    {
        //
    }
}
