<?php

namespace App\Providers;

use App\Repositories\Contracts\IBookedSeatRepository;
use App\Repositories\Contracts\IBookingRepository;
use App\Repositories\Eloquent\BookedSeatRepository;
use App\Repositories\Eloquent\BookingRepository;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
