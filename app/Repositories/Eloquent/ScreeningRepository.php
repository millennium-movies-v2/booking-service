<?php

namespace App\Repositories\Eloquent;

use App\Models\Screening;
use App\Repositories\Contracts\IScreeningRepository;
use Illuminate\Support\Collection;

class ScreeningRepository implements IScreeningRepository
{
    public function getByMovieId(string $movieId): Collection
    {
        return Screening::query()
            ->where('movie_id', $movieId)
            ->orderBy('start_time')
            ->get();
    }
}
