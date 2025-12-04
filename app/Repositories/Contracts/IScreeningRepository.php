<?php

namespace App\Repositories\Contracts;

use App\Models\Screening;
use Illuminate\Support\Collection;

interface IScreeningRepository
{
    public function getByMovieId(string $movieId): Collection;

    public function findById(string $id): Screening;
}
