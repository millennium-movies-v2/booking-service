<?php

namespace Database\Factories;

use App\Models\ReservedSeat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ReservedSeat>
 */
class ReservedSeatFactory extends Factory
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
            'screening_id' => $this->faker->uuid(),
            'seat_id' => $this->faker->uuid(),
        ];
    }
}
