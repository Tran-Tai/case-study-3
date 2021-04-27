<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RouteStation extends Pivot
{
    use HasFactory;
    protected $fillable = ['route_id', 'station_id', 'number', 'arrive_time'];
}
