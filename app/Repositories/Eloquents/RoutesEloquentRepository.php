<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\RoutesRepository;
use App\Models\Route;
use App\Models\RouteStation;

class RoutesEloquentRepository implements RoutesRepository
{
    public function getAll()
    {
        return Route::all();
    }    

    public function getStationList($id)
    {
        
    }
    
    public function get($id)
    {
        return Route::findOrFail($id);
    }

    public function getReverseRoute($number, $direction) 
    {
        $target_direction = 2 / $direction;
        $reverse_route = Route::where('number', '=', $number)
                              ->where('direction', '=', $target_direction)
                              ->first();
        if ($reverse_route === null) return 0;
        else return $reverse_route->id;
    }

    public function create($attributes)
    {
        return Route::create($attributes)->id;
    }

    public function update($id, $attributes)
    {
        $route = $this->get($id);
        $route->name = $attributes['name'];
        $route->gender = $attributes['gender'];
        $route->birthday = $attributes['birthday'];
        $route->address = $attributes['address'];
        $route->role_code = $attributes['role_code'];
        
        return $route->save();
    }

    public function updateReverseRouteId($id, $reverse_route_id)
    {
        $route = $this->get($id);
        $route->reverse_route_id = $reverse_route_id;

        return $route->save();
    }

    public function delete($id)
    {
        $route = $this->get($id);
        $route->destroy($id);
    }
}

