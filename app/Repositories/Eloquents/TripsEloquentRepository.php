<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\TripsRepository;
use App\Models\Trips;

class TripsEloquentRepository implements TripsRepository 
{
    public function getAll($route_id)
    {

    }

    public function get($id)
    {
        
    }

    public function getLastTrip($route_id, $date)
    {
        $last_trip = Trips::where('date', $date)
                       ->where('route_id', $route_id)
                       ->orderBy('number', 'DESC')
                       ->first();
        return $last_trip;
    }

    public function getStatus($route_id, $date, $number)
    {
        $trip = Trips::join('trips_status', 'trips.id', '=', 'trips_status.id')
                       ->where('date', $date)
                       ->where('route_id', $route_id)
                       ->where('number', $number);

        if ($trip === null) return 0;
        else return $$trip->status;
    }


    public function create($attributes)
    {
        return Trips::create($attributes);
    }


    public function update($id, $attributes)
    {
        
    }

    public function updateStatus($id, $status_attributes)
    {
        
    }

    public function delete($id)
    {
        
    }
}
