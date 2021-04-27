<?php

namespace App\Providers;

use App\Repositories\Contracts\BusesRepository;
use App\Repositories\Contracts\RoutesRepository;
use App\Repositories\Contracts\RouteStationRepository;
use App\Repositories\Contracts\StaffsRepository;
use App\Repositories\Contracts\StationsRepository;
use App\Repositories\Contracts\TripsRepository;
use App\Repositories\Eloquents\BusesEloquentRepository;
use App\Repositories\Eloquents\RoutesEloquentRepository;
use App\Repositories\Eloquents\RouteStationEloquentRepository;
use App\Repositories\Eloquents\StaffsEloquentRepository;
use App\Repositories\Eloquents\StationsEloquentRepository;
use App\Repositories\Eloquents\TripsEloquentRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StationsRepository::class, StationsEloquentRepository::class);
        $this->app->bind(StaffsRepository::class, StaffsEloquentRepository::class);
        $this->app->bind(RoutesRepository::class, RoutesEloquentRepository::class);
        $this->app->bind(BusesRepository::class, BusesEloquentRepository::class);
        $this->app->bind(RouteStationRepository::class, RouteStationEloquentRepository::class);
        $this->app->bind(TripsRepository::class, TripsEloquentRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
