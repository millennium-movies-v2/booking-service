<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookingCreationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_post_bookings_returns_201_status_code(): void
    {
        $response = $this->post('/bookings');

        $response->assertStatus(201);
    }
}
