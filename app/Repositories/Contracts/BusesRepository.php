<?php
namespace App\Repositories\Contracts;

use App\Repositories\RepositoryInterface;

interface BusesRepository extends RepositoryInterface {
    public function updatePosition($id, $attributes);
    public function getAvailableBuses($station_id, $timestamp);
}