<?php

namespace App\Http\Controllers;

use App\Http\Resources\ScreeningResource;
use App\Models\Screening;
use App\Services\ScreeningService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MovieScreeningController extends Controller
{
    public function __construct(
        protected ScreeningService $screeningService
    ) {}

    public function index(string $id): AnonymousResourceCollection
    {
        $screenings = $this->screeningService->getScreeningsForMovie($id);

        return ScreeningResource::collection($screenings);
    }
}
