<?php
namespace App\Repositories\Contracts;

use App\Repositories\RepositoryInterface;

interface StaffsRepository extends RepositoryInterface {
    public function getDrivers();
    public function getTicketCollectors();
    public function getOperators();
    public function updatePosition($id, $attributes);
    public function getAvailableStaffs($station_id, $timestamp);
}