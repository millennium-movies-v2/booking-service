<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookingCreationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_that_post_bookings_returns_201_status_code(): void
    {
        $response = $this->post('/bookings');

        $response->assertStatus(201);
    }

    public function test_that_post_bookings_returns_correct_json_structure()
    {
        $bookingData = [
            'user_id'      => $this->faker->uuid(),
            'screening_id' => $this->faker->uuid(),
            'seats' => [
                [
                    'seat_ids' => [
                        $this->faker->uuid(),
                        $this->faker->uuid(),
                    ],
                    'pricing' => [
                        'type'       => 'VIP',
                        'unit_price' => $this->faker->randomFloat(2, 20, 30),
                    ],
                ],
                [
                    'seat_ids' => [
                        $this->faker->uuid(),
                    ],
                    'pricing' => [
                        'type'       => 'Regular',
                        'unit_price' => $this->faker->randomFloat(2, 10, 20),
                    ],
                ],
            ],
        ];

        $response = $this->post('/bookings', $bookingData);

        $response->assertJsonStructure([
            'booking_id',
            'status',
        ]);
    }
}
