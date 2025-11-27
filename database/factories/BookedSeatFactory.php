<?php

namespace Database\Factories;

use App\Models\BookedSeat;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BookedSeat>
 */
class BookedSeatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'booking_id' => Booking::factory(),
            'seat_id' => $this->faker->uuid(),
        ];
    }
}
