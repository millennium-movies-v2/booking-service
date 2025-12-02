<?php

namespace App\Services;

use App\Repositories\Contracts\IScreeningRepository;
use Illuminate\Support\Collection;

class ScreeningService
{
    public function __construct(
        protected IScreeningRepository $screeningRepository
    ) {}

    public function getScreeningsForMovie(string $movieId): Collection
    {
        return $this->screeningRepository->getByMovieId($movieId);
    }
}
