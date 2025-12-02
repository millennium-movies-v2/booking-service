<?php

namespace Tests\Feature;

use App\Models\Screening;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class RetrieveMovieScreeningsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_that_get_movie_screenings_returns_correct_json_structure(): void
    {
        $movie_id = Str::uuid();

        Screening::factory(5)
            ->create([
                'movie_id' => $movie_id,
            ]);

        $response = $this->get(route('movies.screenings.index', $movie_id));

        $response->assertOk();

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'movie_id',
                    'auditorium_id',
                    'start_time',
                    'price'
                ],
            ],
        ]);
    }
}
