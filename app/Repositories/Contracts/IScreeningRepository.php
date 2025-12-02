<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface IScreeningRepository
{
    public function getByMovieId(string $movieId): Collection;
}
