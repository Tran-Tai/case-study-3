<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staffs';
    protected $fillable = ['name', 'gender', 'birthday', 'address', 'role_code', 'user_name', 'password', 'last_workday', 'last_worktime', 'last_station_id'];
}
