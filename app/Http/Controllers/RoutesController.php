<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\RoutesRepository;
use App\Repositories\Contracts\RouteStationRepository;
use App\Repositories\Contracts\StationsRepository;
use Illuminate\Http\Request;

class RoutesController extends Controller
{
    protected $routesRepository;
    protected $routeStationRepository;
    protected $stationsRepository;

    public function __construct(RoutesRepository $routesRepository, 
                                RouteStationRepository $routeStationRepository,
                                StationsRepository $stationsRepository)
    {
        $this->routesRepository = $routesRepository;
        $this->routeStationRepository = $routeStationRepository;
        $this->stationsRepository = $stationsRepository;
    }

    public function index() 
    {
        $routes = $this->routesRepository->getAll();

        return view('routes.list', compact('routes'));
    }

    public function show($id) 
    {
        $route = $this->routesRepository->get($id);
        $stations = $this->routeStationRepository->getByRouteId($id);
        return view('routes.detail', compact('route', 'stations'));
    }

    public function create()
    {
        $stations = $this->stationsRepository->getAll();
        return view('routes.create', compact("stations"));
    }

    public function store(Request $request)
    {
        $time = ($request->time_hour * 3600) + ($request->time_minute * 60) + $request->time_second;
        $time_interval = ($request->time_interval_hour * 3600) + ($request->time_interval_minute * 60) + $request->time_interval_second;
        $direction = $request->direction;
        $reverse_route_id = $this->routesRepository->getReverseRoute($request->number, $direction);
        $last_station_name = 'station_id'.$request->total_station;
        $attributes = [
            'number' => $request->number,
            'name' => $request->name,
            'direction' => $direction,
            'total_station' => $request->total_station,
            'first_station_id' => $request->station_id1,
            'last_station_id' => $request->$last_station_name,
            'total_time' => $time,
            'time_interval' => $time_interval,
            'reverse_route_id' => $reverse_route_id
        ];
        $route_id = $this->routesRepository->create($attributes);
        if ($reverse_route_id != 0) {
            $this->routesRepository->updateReverseRouteId($reverse_route_id, $route_id);
        }
        $time = 0;
        for ($i = 1; $i <= $request->total_station; $i++) {
            $station_id = 'station_id'.$i;
            $number = 'station_number'.$i;
            $minute = 'time_minute'.$i;
            $second = 'time_second'.$i;
            $time += $request->$minute * 60 + $request->$second;
            $attributes = [
                'route_id' => $route_id,
                'station_id' => $request->$station_id,
                'number' => $request->$number,
                'arrive_time' => $time
            ];
            $this->routeStationRepository->create($attributes);

            $this->stationsRepository->insertRoute($request->$station_id, $route_id, $request->number);
        }
        return redirect('/routes/create');
    }

    public function edit($id)
    {
        $route = $this->routesRepository->get($id);
        return view('routes.edit', compact('route'));
    }

    public function update($id, Request $request)
    {
        $attributes = [
            'name' => $request->name
        ];
        $this->routesRepository->update($id, $attributes);

        return redirect('/routes/'.$id);
    }

    public function delete($id)
    {
        return view('routes.delete', compact('id'));
    }

    public function destroy($id)
    {
        $this->routesRepository->delete($id);

        return redirect('/routes');
    }
}
