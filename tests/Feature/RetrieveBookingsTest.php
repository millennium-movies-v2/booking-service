<?php

namespace Tests\Feature;

use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class RetrieveBookingsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_that_get_bookings_returns_correct_json_structure(): void
    {
        $userId = Str::uuid();

        Booking::factory(10)->create([
            'user_id' => $userId,
        ]);

        $response = $this
        ->withHeader('X-User-Id', $userId)
        ->get(route('bookings.index'));

        $response->assertOk();

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'user_id',
                    'price',
                    'status' => [
                       'id',
                       'name',
                    ],
                ],
            ],
        ]);
    }
}
