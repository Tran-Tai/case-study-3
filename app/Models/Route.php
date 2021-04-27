<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'name', 'direction', 'total_station', 'first_station_id', 'last_station_id', 'total_time', 'time_interval', 'reverse_route_id'];

    public function stations() 
    {
        return $this->belongsToMany(Station::class)->using(RouteStation::class);
    }
}
