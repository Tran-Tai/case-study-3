<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\StaffsRepository;
use App\Models\Staff;

class StaffsEloquentRepository implements StaffsRepository
{
    public function getAll()
    {
        return Staff::all();
    }

    public function getDrivers()
    {
        return Staff::where('role_code', '1')
                    ->get();
    }
    public function getTicketCollectors()
    {
        return Staff::where('role_code', '2')
                    ->get();
    }

    public function getAvailableStaffs($station_id, $timestamp)
    {
        $date = date('Y-m-d', strtotime($timestamp));
        $staffs = Staff::where('last_workday', '<', $date)
                       ->orWhere([
                            ['last_station_id', $station_id],
                            ['last_worktime', '<', $timestamp]
                       ])
                       ->orWhere([
                            ['last_station_id', 0],
                            ['last_worktime', '<', $timestamp]
                    ])
                      ->get();
        return $staffs;
    }

    public function getOperators()
    {

    }

    public function get($id)
    {
        return Staff::findOrFail($id);
    }

    public function create($attributes)
    {
        return Staff::create($attributes);
    }

    public function update($id, $attributes)
    {
        $staff = $this->get($id);
        $staff->name = $attributes['name'];
        $staff->gender = $attributes['gender'];
        $staff->birthday = $attributes['birthday'];
        $staff->address = $attributes['address'];
        $staff->role_code = $attributes['role_code'];
        
        return $staff->save();
    }

    public function updatePosition($id, $attributes)
    {
        $staff = $this->get($id);
        $staff->last_workday = $attributes['last_workday'];
        $staff->last_worktime = $attributes['last_worktime'];
        $staff->last_station_id = $attributes['last_station_id'];
        
        return $staff->save();
    }

    public function delete($id)
    {
        $staff = $this->get($id);
        $staff->destroy($id);
    }
}

