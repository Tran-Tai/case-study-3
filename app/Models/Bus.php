<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'seat', 'capacity', 'route_id1', 'route_id2',  'last_workday', 'last_worktime', 'last_station_id'];
}
