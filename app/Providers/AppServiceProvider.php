<?php

namespace App\Providers;

use App\Repositories\Contracts\IBookedSeatRepository;
use App\Repositories\Contracts\IBookingRepository;
use App\Repositories\Contracts\IScreeningRepository;
use App\Repositories\Eloquent\BookedSeatRepository;
use App\Repositories\Eloquent\BookingRepository;
use App\Repositories\Eloquent\ScreeningRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IBookingRepository::class, BookingRepository::class);
        $this->app->bind(IBookedSeatRepository::class, BookedSeatRepository::class);
        $this->app->bind(IScreeningRepository::class, ScreeningRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
