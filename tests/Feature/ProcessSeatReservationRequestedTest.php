<?php

namespace Tests\Feature;

use App\Events\SeatReservationConfirmed;
use App\Events\SeatReservationFailed;
use App\Events\SeatReservationRequested;
use App\Listeners\ProcessSeatReservationRequested;
use App\Repositories\Contracts\IReservedSeatRepository;
use App\Services\SeatReservationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class ProcessSeatReservationRequestedTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    protected IReservedSeatRepository $reservedSeatRepository;
    protected SeatReservationService $seatReservationService;
    protected ProcessSeatReservationRequested $listener;

    protected function setUp(): void
    {
        parent::setUp();

        Event::fake([
            SeatReservationConfirmed::class,
            SeatReservationFailed::class,
        ]);

        $this->reservedSeatRepository = \Mockery::mock(IReservedSeatRepository::class);

        $this->seatReservationService = new SeatReservationService($this->reservedSeatRepository);

        $this->listener = new ProcessSeatReservationRequested($this->seatReservationService);
    }

    public function test_it_confirms_seat_reservation_when_all_seats_available()
    {
        $this->reservedSeatRepository->shouldReceive('areSeatsAvailable')
             ->once()
             ->with('screening-123', ['A1', 'A2'])
             ->andReturn(true);

        $event = new SeatReservationRequested(
            'booking-123',
            'screening-123',
            ['A1', 'A2']
        );

        $this->listener->handle($event);

        Event::assertDispatched(SeatReservationConfirmed::class);
        Event::assertNotDispatched(SeatReservationFailed::class);
    }

    protected function tearDown(): void
    {
        \Mockery::close();
        parent::tearDown();
    }

}
