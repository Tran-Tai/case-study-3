<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\RouteStationRepository;
use App\Models\RouteStation;

class RouteStationEloquentRepository implements RouteStationRepository
{
    public function getAll()
    {

    }
    public function getByRouteId($route_id)
    {
        $stations = RouteStation::where('route_id', $route_id)
                                ->leftJoin('stations', 'route_station.station_id', '=', 'stations.id')
                                ->orderBy('number')
                                ->select('route_station.*','stations.name', 'stations.routes_list')
                                ->get();
        return $stations;
    }
    public function getByStationId($station_id)
    {

    }

    public function create($attributes)
    {
        return RouteStation::create($attributes);
    }
    public function update($route_id, $station_id, $attributes)
    {

    }
    public function delete($route_id, $station_id)
    {

    }
}