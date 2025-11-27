<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookingCreationTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    private function bookingData(): array
    {
        return [
            'user_id'      => $this->faker->uuid(),
            'screening_id' => $this->faker->uuid(),
            'seats' => [
                [
                    'seat_ids' => [
                        $this->faker->uuid(),
                        $this->faker->uuid(),
                    ],
                    'pricing' => [
                        'type'       => 'Regular',
                        'unit_price' => $this->faker->randomFloat(2, 10, 20),
                    ],
                ],
                [
                    'seat_ids' => [
                        $this->faker->uuid(),
                        $this->faker->uuid(),
                        $this->faker->uuid(),
                    ],
                    'pricing' => [
                        'type'       => 'VIP',
                        'unit_price' => $this->faker->randomFloat(2, 10, 20),
                    ],
                ],
            ],
        ];
    }

    public function test_that_post_bookings_returns_201_status_code(): void
    {
        $response = $this->post('/bookings', $this->bookingData());

        $response->assertStatus(201);
    }

    public function test_that_post_bookings_returns_correct_json_structure(): void
    {
        $bookingData = $this->bookingData();

        $response = $this->post('/bookings', $bookingData);

        $response->assertJsonStructure([
            'booking_id',
            'status',
        ]);
    }
}
