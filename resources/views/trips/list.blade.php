@extends('layouts.admin-layout')
@section('title')
    Trips List
@endsection
@section('header')
    Danh sách chuyến
@endsection
@section('body')
<div class="container text-center col-10 my-1 p-1">
    <p>Tuyến số {{$route->number}}: {{$route->name}}, 
        @switch($route->direction)
            @case(1)
                tuyến đi
                @break
            @case(2)
                tuyến về
                @break
        @endswitch
    </p>
    <p>Khởi hành từ {{$first_station->name}} đến {{$last_station->name}}</p>
</div>
<div class="container col-10 my-1 p-1">
        <table class="table table-sm table-bordered table-striped table-hover">
            <thead class="thead-dark text-center">
                <tr>
                    <th>STT</th>
                    <th>Ngày</th>
                    <th>STT chuyến trong ngày</th>
                    <th>Giờ khởi hành</th>
                    <th>Giờ kết thúc</th>
                    <th>Số xe</th>
                    <th>Lái xe</th>
                    <th>NV soát vé</th>
                    <th></th>
                </tr>
            </thead>
            @foreach($trips as $key=>$trip)
                <tr>
                    <td class="text-center align-middle">{{$key + 1}}</td>
                    <td class="text-center align-middle">{{date('d/m/Y', strtotime($trip->date))}}</td>
                    <td class="text-center align-middle">{{$trip->number}}</td>
                    <td class="text-center align-middle">{{date('h:i:s', strtotime($trip->start_time))}}</td>
                    <td class="text-center align-middle">{{date('h:i:s', strtotime($trip->end_time))}}</td>
                    <td class="text-center align-middle">{{$trip->bus_number}}</td>
                    <td class="align-middle">{{$trip->driver_name}}</td>
                    <td class="align-middle">{{$trip->ticket_collector_name}}</td>
                    <td class="text-center align-middle"><a type="button" class="btn btn-primary" href="/trips/{{$trip->id}}">Chi tiết</a></td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="text-center container"><a type="button" class="btn btn-primary" href="/routes/{{$trip->route_id}}">Quay lại thông tin tuyến</a></div>
@endsection