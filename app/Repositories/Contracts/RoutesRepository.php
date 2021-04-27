<?php
namespace App\Repositories\Contracts;

use App\Repositories\RepositoryInterface;

interface RoutesRepository extends RepositoryInterface {
    public function getStationList($id);
    public function getReverseRoute($number, $direction);
    public function updateReverseRouteId($id, $reverse_route_id);
}

