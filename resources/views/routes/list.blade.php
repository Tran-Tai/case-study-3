@extends('layouts.admin-layout')
@section('title')
    Routes List
@endsection
@section('header')
    Danh sách tuyến
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
    <div class="container col-8 my-1 p-1">
        <table class="table table-sm table-bordered table-striped table-hover">
            <thead class="thead-dark text-center">
                <tr>
                    <th>STT</th>
                    <th>Số tuyến</th>
                    <th>Tên tuyến</th>
                    <th>Chiều</th>
                    <th>Tổng số trạm</th>
                    <th>Thời gian hành trình</th>
                    <th>Thời gian giãn cách</th>
                    <th></th>
                </tr>
            </thead>
            @foreach($routes as $key=>$route)
                <tr>
                    <td class="text-center align-middle">{{$key + 1}}</td>
                    <td class="pl-3 align-middle">{{$route->number}}</td>
                    <td class="pl-3 align-middle">{{$route->name}}</td>
                    <td class="pl-3 align-middle">
                        @switch($route->direction)
                            @case(1)
                                Đi
                                @break
                            @case(2)
                                Về
                                @break
                        @endswitch
                    </td>
                    <td class="pl-3 align-middle">{{$route->total_station}}</td>
                    <td class="pl-3 align-middle">{{formatTime($route->total_time)}}</td>
                    <td class="pl-3 align-middle">{{formatTime($route->time_interval)}}</td>
                    <td class="text-center align-middle"><a type="button" class="btn btn-primary" href="/routes/{{$route->id}}">Chi tiết</a></td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="container text-center my-3 p-1">
        <a type="button" class="btn btn-primary" href="/routes/create">Thêm tuyến</a>
    </div>
@endsection