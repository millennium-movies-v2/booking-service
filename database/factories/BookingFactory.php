<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Booking>
 */
class BookingFactory extends Factory
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
            'user_id' => $this->faker->uuid(),
            'price' => $this->faker->randomFloat(2),
            'status_id' => Status::factory(),
        ];
    }
}
