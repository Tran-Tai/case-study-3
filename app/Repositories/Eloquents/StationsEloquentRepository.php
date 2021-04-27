<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\StationsRepository;
use App\Models\Station;

class StationsEloquentRepository implements StationsRepository
{
    public function getAll()
    {
        return Station::all();
    }

    public function get($id)
    {
        return Station::findOrFail($id);
    }

    public function create($attributes)
    {
        return Station::create($attributes);
    }

    public function update($id, $attributes)
    {
        $station = $this->get($id);
        $station->name = $attributes['name'];

        return $station->save();
    }

    public function insertRoute($id, $route_id, $route_number)
    {
        $station = $this->get($id);
        $routeElement = $route_id . "-" . $route_number;
        $routes_list_arr = explode(' ', $station->routes_list);
        $routes_list_arr[] = $routeElement;
        $routes_list_str = implode(' ', $routes_list_arr);

        $station->routes_list = $routes_list_str;

        return $station->save();
    }

    public function delete($id)
    {
        $station = $this->get($id);
        $station->destroy($id);
    }
}
