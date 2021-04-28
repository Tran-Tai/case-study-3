<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\BusesRepository;
use App\Repositories\Contracts\TripsRepository;
use App\Repositories\Contracts\RoutesRepository;
use App\Repositories\Contracts\RouteStationRepository;
use App\Repositories\Contracts\StaffsRepository;
use App\Repositories\Contracts\StationsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TripsController extends Controller
{
    protected $tripsRepository;
    protected $routesRepository;
    protected $staffsRepository;
    protected $stationsRepository;
    protected $busesRepository;
    protected $routeStationRepository;

    public function __construct(TripsRepository $tripsRepository, 
                                RoutesRepository $routesRepository,
                                StaffsRepository $staffsRepository,
                                StationsRepository $stationsRepository,
                                BusesRepository $busesRepository,
                                RouteStationRepository $routeStationRepository)
    {
        $this->tripsRepository = $tripsRepository;
        $this->routesRepository = $routesRepository;
        $this->staffsRepository = $staffsRepository;
        $this->stationsRepository = $stationsRepository;
        $this->busesRepository = $busesRepository;
        $this->routeStationRepository = $routeStationRepository;
    }

    public function create($route_id)
    {
        $route = $this->routesRepository->get($route_id);
        $drivers = $this->staffsRepository->getDrivers();
        $ticket_collectors = $this->staffsRepository->getTicketCollectors();
        $buses = $this->busesRepository->getAll();
        return view('trips.create', compact('route', 'drivers', 'ticket_collectors', 'buses'));
    }

    public function store($route_id, Request $request)
    {
        $route = $this->routesRepository->get($route_id);
        $date = strtotime($request->date);
        $date_text = date("Y-m-d", $date);
        $end_hour = $request->end_hour;
        $end_minute = $request->end_minute;
        $end_second = $request->end_second;
        $start_time_text = $request->start_hour . ":" . $request->start_minute . ":" . $request->start_second;
        $end_time_text = $end_hour . ":" . $end_minute . ":" . $end_second;
        $last_trip = $this->tripsRepository->getLastTrip($route_id, $request->date);
        if (isset($last_trip)) {
            $number = $last_trip->number + 1;
            $last_status = $last_trip->status;
            if ($last_status > 1) $status = 1;
            else $status = 0;
        }
        else {
            $number = 1;
            $status = 1;
        }
        $attributes = [
            'route_id' => $route_id,
            'date' => $request->date,
            'number' => $number,
            'start_time' => $date_text . " " . $start_time_text,
            'end_time' => $date_text . " " . $end_time_text,
            'bus_id' => $request->bus_id,
            'driver_id' => $request->driver_id,
            'ticket_collector_id' => $request->ticket_collector_id,
            'operator_id' => 1,
            'next_station_id' => $route->first_station_id,
            'status' => $status,
            'arrive_at' => $date_text . " " . $start_time_text,
            'passenger' => 0
        ];
        $store_success = $this->tripsRepository->create($attributes);

        if ($store_success) Session::flash('success', 'Đã thêm thông tin chuyến thành công');
        else Session::flash('fail', 'Đã có lỗi xảy ra');

        if ($end_minute > 30) {
            $end_minute = $end_minute - 30;
            $end_hour = $end_hour + 1;
            if ($end_minute < 10) $end_minute = "0" . $end_minute;
            if ($end_hour < 10) $end_hour = "0" . $end_hour;
        }
        else {
            $end_minute = $end_minute + 30;
            if ($end_minute < 10) $end_minute = "0" . $end_minute;
        }

        $end_time_text = $end_hour . ":" . $end_minute . ":" . $end_second;

        $position_attributes = [
            'last_workday' => $request->date, 
            'last_worktime' => $date_text . " " . $end_time_text, 
            'last_station_id' => $route->last_station_id
        ];
        $this->busesRepository->updatePosition($request->bus_id, $position_attributes);
        $this->staffsRepository->updatePosition($request->driver_id, $position_attributes);
        $this->staffsRepository->updatePosition($request->ticket_collector_id, $position_attributes);
        return redirect("trips/create/$route_id");
    }

    public function info(Request $request)
    {
        $route_id = $request->route_id;
        $route = $this->routesRepository->get($route_id);
        $station_id = $route->first_station_id;
        $date = $request->date;
        $hour = $request->hour;
        $minute = $request->minute;
        $second = $request->second;
        $timestamp = $date . " " . $hour . ":" . $minute . ":" . $second;
        $staffs = $this->staffsRepository->getAvailableStaffs($station_id, $timestamp);
        $drivers = [];
        $ticket_collectors = [];
        foreach ($staffs as $staff) {
            if ($staff->role_code == 1) {
                $drivers[] = $staff;
            }
            if ($staff->role_code == 2) {
                $ticket_collectors[] = $staff;
            }
        }
        $buses = $this->busesRepository->getAvailableBuses($station_id, $timestamp);
        return view('trips.info', compact('drivers', 'ticket_collectors', 'buses'));
    }

    public function index($route_id)
    {
        $trips = $this->tripsRepository->getAll($route_id);
        $route = $this->routesRepository->get($route_id);
        $first_station = $this->stationsRepository->get($route->first_station_id);
        $last_station = $this->stationsRepository->get($route->last_station_id);
        return view('trips.list', compact('trips', 'route', 'first_station', 'last_station'));
    }

    public function show($id)
    {
        $trip = $this->tripsRepository->get($id);
        $route = $this->routesRepository->get($trip->route_id);
        $stations = $this->routeStationRepository->getByRouteId($route->id);
        return view('trips.detail', compact('trip', 'route', 'stations'));
    }
}
