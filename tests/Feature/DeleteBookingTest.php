<?php

namespace Tests\Feature;

use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class DeleteBookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_that_delete_booking_returns_success(): void
    {
        $userId = (string) Str::uuid();

        $booking = Booking::factory()->create([
            'user_id' => $userId,
        ]);

        $response = $this->withHeader('X-User-Id', $userId)
                         ->delete(route('bookings.destroy', ['booking' => $booking->id]));

        $response->assertOk();

        $this->assertDatabaseMissing('bookings', [
            'id' => $booking->id,
            'user_id' => $userId,
        ]);

    }
}
