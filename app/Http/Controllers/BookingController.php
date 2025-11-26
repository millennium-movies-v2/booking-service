<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;

class BookingController extends Controller
{
    public function store(StoreBookingRequest $request)
    {
        return response(status: 201);
    }

}
