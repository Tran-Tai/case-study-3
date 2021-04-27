<?php
namespace App\Repositories\Contracts;


interface RouteStationRepository {
    public function getAll();
    public function getByRouteId($route_id);
    public function getByStationId($station_id);
    public function create($attributes);
    public function update($route_id, $station_id, $attributes);
    public function delete($route_id, $station_id);
}