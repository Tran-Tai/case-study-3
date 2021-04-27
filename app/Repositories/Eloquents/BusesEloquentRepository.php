<?php

namespace App\Repositories\Eloquents;

use App\Models\Bus;
use App\Repositories\Contracts\BusesRepository;

class BusesEloquentRepository implements BusesRepository
{
    public function getAll()
    {
        return Bus::all();
    }

    public function getAllName()
    {
        return Bus::groupBy('number')->select('number', 'name')->get();
    }
    
    public function getAvailableBuses($station_id, $timestamp)
    {
        $buses = Bus::whereIn('last_station_id', [$station_id, 0])
                    ->where('last_worktime', '<', $timestamp)
                    ->get();
        return $buses;

    }

    public function get($id)
    {
        return Bus::findOrFail($id);
    }

    public function create($attributes)
    {
        return Bus::create($attributes);
    }

    public function update($id, $attributes)
    {
        $bus = $this->get($id);
        $bus->number = $attributes['number'];
        $bus->seat = $attributes['seat'];
        $bus->capacity = $attributes['capacity'];
        $bus->route_id1 = $attributes['route_id1'];
        $bus->route_id2 = $attributes['route_id2'];
        
        return $bus->save();
    }

    public function updatePosition($id, $attributes)
    {
        $bus = $this->get($id);
        $bus->last_workday = $attributes['last_workday'];
        $bus->last_worktime = $attributes['last_worktime'];
        $bus->last_station_id = $attributes['last_station_id'];
        
        return $bus->save();
    }

    public function delete($id)
    {
        $bus = $this->get($id);
        $bus->destroy($id);
    }
}

