<?php

namespace Tests\Feature;

use App\Events\SeatReservationRequested;
use App\Models\Screening;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class BookingCreationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private function createScreening(float $price = 15.0): Screening
    {
        return Screening::factory()->create(['price' => $price]);
    }

    private function bookingData(): array
    {
        return [
            'seats' => [
                'Regular' => [$this->faker->uuid(), $this->faker->uuid()],
                'VIP'     => [$this->faker->uuid(), $this->faker->uuid(), $this->faker->uuid()],
            ],
        ];
    }

    private function postBooking(array $data, string $userId, string $screeningId)
    {
        $payload = array_merge($data, ['screening_id' => $screeningId]);

        return $this->withHeader('X-User-Id', $userId)
                    ->postJson('/bookings', $payload);
    }

    public function test_post_bookings_returns_201_status_code(): void
    {
        $screening = $this->createScreening();
        $userId = $this->faker->uuid();

        $response = $this->postBooking($this->bookingData(), $userId, $screening->id);

        $response->assertStatus(201);
    }

    public function test_post_bookings_returns_correct_json_structure(): void
    {
        $screening = $this->createScreening();
        $userId = $this->faker->uuid();

        $response = $this->postBooking($this->bookingData(), $userId, $screening->id);

        $response->assertJsonStructure([
            'booking_id',
            'status',
        ]);
    }

    public function test_booking_is_created_in_database(): void
    {
        $screening = $this->createScreening();
        $userId = $this->faker->uuid();

        $this->postBooking($this->bookingData(), $userId, $screening->id);

        $this->assertDatabaseHas('bookings', ['user_id' => $userId]);
    }

    public function test_booking_creates_booked_seat_entries(): void
    {
        $screening = $this->createScreening();
        $userId = $this->faker->uuid();
        $data = $this->bookingData();

        $totalSeats = collect($data['seats'])->flatMap(fn($group) => $group)->count();

        $this->postBooking($data, $userId, $screening->id);

        $this->assertDatabaseCount('booked_seats', $totalSeats);
    }

    public function test_booking_dispatches_seat_reservation_event(): void
    {
        Event::fake([SeatReservationRequested::class]);

        $screening = $this->createScreening();
        $userId = $this->faker->uuid();
        $data = $this->bookingData();

        $this->postBooking($data, $userId, $screening->id);

        Event::assertDispatched(SeatReservationRequested::class);
    }
}
