<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\StaffsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StaffsController extends Controller
{
    protected $staffsRepository;

    public function __construct(StaffsRepository $staffsRepository)
    {
        $this->staffsRepository = $staffsRepository;
    }

    public function index() 
    {
        $staffs = $this->staffsRepository->getAll();
        return view('staffs.list', compact('staffs'));
    }

    public function show($id) 
    {
        $staff = $this->staffsRepository->get($id);
        return view('staffs.detail', compact('staff'));
    }

    public function create()
    {
        return view('staffs.create');
    }

    public function store(Request $request)
    {
        $attributes = [
            'name' => $request->name,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'address' => $request->address,
            'role_code' => $request->role,
            'user_name' => '',
            'password' => '', 
            'last_workday' => date("Y-m-d"), 
            'last_worktime' => date("Y-m-d H:i:s"), 
            'last_station_id' => 0
        ];
        $store_success = $this->staffsRepository->create($attributes);

        if ($store_success) Session::flash('success', 'Đã thêm thông tin nhân viên thành công');
        else Session::flash('fail', 'Đã có lỗi xảy ra');

        return view('staffs.create');
    }

    public function edit($id)
    {
        $staff = $this->staffsRepository->get($id);
        return view('staffs.edit', compact('staff'));
    }

    public function update($id, Request $request)
    {
        $attributes = [
            'name' => $request->name,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'address' => $request->address,
            'role_code' => $request->role
        ];
        $edit_success = $this->staffsRepository->update($id, $attributes);

        if ($edit_success) Session::flash('success', 'Đã chỉnh sửa thông tin nhân viên thành công');
        else Session::flash('fail', 'Đã có lỗi xảy ra');


        return redirect('/staffs/'.$id);
    }

    public function delete($id)
    {
        return view('staffs.delete', compact('id'));
    }

    public function destroy($id)
    {
        $this->staffsRepository->delete($id);

        return redirect('/staffs');
    }
}