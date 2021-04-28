<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\StationsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StationsController extends Controller
{
    protected $stationsRepository;

    public function __construct(StationsRepository $stationsRepository)
    {
        $this->stationsRepository = $stationsRepository;
    }

    public function index() 
    {
        $stations = $this->stationsRepository->getAll();

        return view('stations.list', compact('stations'));
    }

    public function show($id) 
    {
        $station = $this->stationsRepository->get($id);
        return view('stations.detail', compact('station'));
    }

    public function create()
    {
        return view('stations.create');
    }

    public function store(Request $request)
    {
        $attributes = [
            'name' => $request->name,
            'routes_list' => ''
        ];
        $store_success = $this->stationsRepository->create($attributes);

        if ($store_success) Session::flash('success', 'Đã thêm thông tin trạm thành công');
        else Session::flash('fail', 'Đã có lỗi xảy ra');

        return view('stations.create');
    }

    public function edit($id)
    {
        $station = $this->stationsRepository->get($id);
        return view('stations.edit', compact('station'));
    }

    public function update($id, Request $request)
    {
        $attributes = [
            'name' => $request->name
        ];
        $edit_success = $this->stationsRepository->update($id, $attributes);

        if ($edit_success) Session::flash('success', 'Đã chỉnh sửa thông tin trạm thành công');
        else Session::flash('fail', 'Đã có lỗi xảy ra');


        return redirect('/stations/'.$id);
    }

    public function delete($id)
    {
        return view('stations.delete', compact('id'));
    }

    public function destroy($id)
    {
        $this->stationsRepository->delete($id);

        return redirect('/stations');
    }
}
