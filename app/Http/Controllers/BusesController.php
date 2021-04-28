<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\BusesRepository;
use App\Repositories\Contracts\RoutesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BusesController extends Controller
{
    protected $busesRepository;
    protected $routesRepository;

    public function __construct(BusesRepository $busesRepository, RoutesRepository $routesRepository)
    {
        $this->busesRepository = $busesRepository;
        $this->routesRepository = $routesRepository;
    }

    public function index()
    {
        $buses = $this->busesRepository->getAll();

        return view('buses.list', compact('buses'));
    }

    public function show($id) 
    {
        $bus = $this->busesRepository->get($id);
        $route1 = $this->routesRepository->get($bus->route_id1);
        $route2 = $this->routesRepository->get($bus->route_id2);
        return view('buses.detail', compact('bus', 'route1', 'route2'));
    }

    public function create()
    {
        $routes = $this->routesRepository->getAll();
        return view('buses.create', compact('routes'));
    }

    public function store(Request $request)
    {
        $attributes = [
            'number' => $request->number,
            'seat' => $request->seat,
            'capacity' => $request->capacity,
            'route_id1' => $request->route_id1,
            'route_id2' => $request->route_id2,
            'last_workday' => date("Y-m-d"), 
            'last_worktime' => date("Y-m-d H:i:s"), 
            'last_station_id' => 0
        ];
        $store_success = $this->busesRepository->create($attributes);
        if ($store_success) Session::flash('success', 'Đã thêm thông tin xe thành công');
        else Session::flash('fail', 'Đã có lỗi xảy ra');

        return redirect('/buses/create');
    }

    public function edit($id)
    {
        $bus = $this->busesRepository->get($id);
        $routes = $this->routesRepository->getAll();
        return view('buses.edit', compact('bus', 'routes'));
    }

    public function update($id, Request $request)
    {
        $attributes = [
            'number' => $request->number,
            'seat' => $request->seat,
            'capacity' => $request->capacity,
            'route_id1' => $request->route_id1,
            'route_id2' => $request->route_id2
        ];
        
        $edit_success = $this->busesRepository->update($id, $attributes);

        if ($edit_success) Session::flash('success', 'Đã chỉnh sửa thông tin xe thành công');
        else Session::flash('fail', 'Đã có lỗi xảy ra');

        return redirect('/buses/'.$id);
    }

    public function delete($id)
    {
        return view('buses.delete', compact('id'));
    }

    public function destroy($id)
    {
        $this->busesRepository->delete($id);

        return redirect('/buses');
    }
}

