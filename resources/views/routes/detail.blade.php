@extends('layouts.admin-layout')
@section('title')
route Info
@endsection
@section('body')
@php
    function formatTime($time)
    {
        $second = $time % 60;
        $time_in_minute = ($time - $second) / 60;
        $minute = $time_in_minute % 60;
        $hour = ($time_in_minute - $minute) / 60;

        if ($second < 10) $second = "0" . $second;
        if ($minute < 10) $minute = "0" . $minute;
        if ($hour < 10) $hour = "0" . $hour;

        if ($hour < 1) 
            echo $minute . ":" . $second;
        else echo $hour . ":" . $minute . ":" . $second;
    }
@endphp
<div class="container col-6 my-1 p-1">
    <form>
        <legend>Thông tin tuyến đường</legend>
        <div class="form-group">
            <label>Số tuyến</label>
            <p class="form-control">{{$route->number}}</p>
        </div>
        <div class="form-group">
            <label>Tên tuyến</label>
            <p class="form-control">{{$route->name}}</p>
        </div>
        <div class="form-group">
            <label>Hướng đi</label>
            <p class="form-control">
                @switch($route->direction)
                    @case(1)
                        Tuyến đi
                        @break
                    @case(2)
                        Tuyến về
                        @break
                @endswitch
            </p>
        </div>
        <div class="form-group">
            <label">Tổng số trạm</label>
            <p class="form-control">{{$route->total_station}}</p>
        </div>
        <div class="form-group">
            <label>Thời gian hành trình</label>
            <p class="form-control">{{formatTime($route->total_time)}}</p>
        </div>
        <div class="form-group">
            <label>Thời gian giãn cách</label>
            <p class="form-control">{{formatTime($route->time_interval)}}</p>
        </div>
    </form>
</div>

<div class="text-center container col-6"><a href="/routes/{{$route->id}}/edit"
                                type="button" 
                                class="btn btn-info py-1 px-3 my-0 rounded float-left">Sửa</a> 
                            <!-- <a href="/routes/{{$route->id}}/delete"
                                type="button" 
                                class="btn btn-danger py-1 px-3 mx-5 my-0 rounded float-left">Xóa</a> -->
                            <a href="/routes" 
                                type="button" 
                                class="btn btn-primary py-1 px-3 my-0 rounded float-right">Quay lại danh sách</a>
</div>

<div class="container col-8 mt-5 p-1 clearfix">
    <legend>Chi tiết các trạm dừng</legend>
    <table class="table table-sm table-bordered table-striped table-hover">
        <thead class="thead-dark text-center">
            <tr>
                <th>STT</th>
                <th>Số trạm</th>
                <th>Tên trạm</th>
                <th>Thời gian đến trạm</th>
                <th>Các tuyến đi qua trạm</th>
            </tr>
        </thead>
        <tbody>
        @foreach($stations as $key=>$station)
            <tr>
                <td class="text-center">{{$key + 1}}</td>
                <td class="text-center">{{$station->number}}</td>
                <td class="pl-5">{{$station->name}}</td>
                <td class="text-center">{{formatTime($station->arrive_time)}}</td>
                <td class="pl-5">
                    @php
                        $routes_list_arr = explode(' ', $station->routes_list);
                        foreach($routes_list_arr as $route_list_str) {
                            $pos = strpos($route_list_str, "-");
                            $id = substr($route_list_str,0,$pos);
                            $name = substr($route_list_str,$pos+1);
                            echo "<a href='/routes/" . $id . "'>" . $name . " </a>";
                        }
                    @endphp
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="text-center container">
    <a href="/trips/route/{{$route->id}}" 
        type="button" 
        class="btn btn-primary py-1 px-3 mx-5 mt-0 mb-5 rounded">Xem danh sách chuyến</a>
    <a href="/trips/create/{{$route->id}}" 
        type="button" 
        class="btn btn-primary py-1 px-3 mx-5 mt-0 mb-5 rounded">Tạo chuyến mới</a>
    @if ($route->reverse_route_id != 0)
        <a href="/routes/{{$route->reverse_route_id}}"
            type="button" 
            class="btn btn-info py-1 px-3 mx-5 mt-0 mb-5 rounded">
            @switch($route->direction)
                @case(1)
                    Xem tuyến về
                    @break
                @case(2)
                    Xem tuyến đi
                    @break
            @endswitch           
        </a>
    @endif
</div>
@endsection