<?php
namespace App\Repositories\Contracts;

use App\Repositories\RepositoryInterface;

interface StationsRepository extends RepositoryInterface {
    public function insertRoute($id, $route_id, $route_number);
}