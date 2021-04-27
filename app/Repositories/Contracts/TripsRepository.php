<?php
namespace App\Repositories\Contracts;

use App\Repositories\RepositoryInterface;

interface TripsRepository {
    public function getAll($route_id);
    public function get($id);
    public function getLastTrip($route_id, $date);
    public function create($attributes);
    public function update($id, $attributes);
    public function delete($id);
}