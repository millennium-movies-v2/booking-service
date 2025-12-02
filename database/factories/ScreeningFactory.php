<?php

namespace Database\Factories;

use App\Models\Screening;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Screening>
 */
class ScreeningFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'movie_id' => $this->faker->uuid(),
            'auditorium_id' => $this->faker->uuid(),
            'start_time' => $this->faker->time(),
            'price' => $this->faker->randomFloat(2),
        ];
    }
}
