<?php

namespace App\Http\Controllers;

use App\Http\Resources\ScreeningResource;
use App\Models\Screening;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MovieScreeningController extends Controller
{

    public function index(string $id): AnonymousResourceCollection
    {
        $screenings = Screening::query()
            ->where(['movie_id' => $id,])
            ->get();

        return ScreeningResource::collection($screenings);

    }
}
