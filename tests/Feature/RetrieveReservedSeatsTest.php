<?php

namespace Tests\Feature;

use App\Models\ReservedSeat;
use App\Models\Screening;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RetrieveReservedSeatsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_that_get_reserved_seats_returns_correct_json_structure(): void
    {
        $screening = Screening::factory()->create();

        ReservedSeat::factory(5)->create([
            'screening_id' => $screening->id,
        ]);

        $response = $this->get('/screenings/'. $screening->id . '/reserved-seats');

        $response->assertOk();

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'screening_id',
                    'seat_id',
                ],
            ],
        ]);
    }
}

