<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trips extends Model
{
    use HasFactory;

    protected $fillable = ['route_id', 'date', 'number', 'start_time', 'end_time', 'bus_id', 'driver_id', 'ticket_collector_id', 'operator_id', 'next_station_id', 'status', 'arrive_at', 'passenger'];
}
