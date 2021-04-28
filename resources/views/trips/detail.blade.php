@extends('layouts.admin-layout')
@section('title')
Trip Info
@endsection
@section('body')
<div class="container col-6 my-1 p-1">
    <form>
        <legend>Thông tin chuyến</legend>
        <div class="form-group">
            <label for="name">Tuyến</label>
            <p class="form-control">Số {{$route->number}}: {{$route->name}},
                @switch($route->direction)
                @case(1)
                tuyến đi
                @break
                @case(2)
                tuyến về
                @break
                @endswitch
            </p>
        </div>
        <div class="form-group">
            <label for="date">Ngày</label>
            <p class="form-control">{{date('d/m/Y', strtotime($trip->date))}}</p>
        </div>
        <div class="form-group">
            <label for="time">Thời gian khởi hành</label> <br>
            <p class="form-control col-6">{{date('h:i:s',strtotime($trip->start_time))}}</p>
        </div>
        <div class="form-group">
            <label for="time">Thời gian kết thúc</label> <br>
            <p class="form-control col-6">{{date('h:i:s',strtotime($trip->end_time))}}</p>
        </div>
        <div class="form-group">
            <label for="bus_id">Số xe</label>
            <p class="form-control">{{$trip->bus_number}}</p>
        </div>
        <div class="form-group">
            <label for="driver_id">Lái xe</label>
            <p class="form-control">{{$trip->driver_name}}</p>
        </div>
        <div class="form-group">
            <label for="ticket_collector_id">Soát vé</label>
            <p class="form-control">{{$trip->ticket_collector_name}}</p>
        </div>
</div>
<div class="container col-8 mt-5 p-1">
    <legend>Chi tiết các trạm dừng</legend>
    <table class="table table-sm table-bordered table-striped table-hover">
        <thead class="thead-dark text-center">
            <tr>
                <th>STT</th>
                <th>Số trạm</th>
                <th>Tên trạm</th>
                <th>Thời điểm đến trạm</th>
            </tr>
        </thead>
        <tbody>
        @foreach($stations as $key=>$station)
            <tr>
                <td class="text-center">{{$key + 1}}</td>
                <td class="text-center">{{$station->number}}</td>
                <td class="pl-5">{{$station->name}}</td>
                @php
                    $arrive_time = strtotime($trip->start_time) + $station->arrive_time; 
                    $current_time = strtotime("now");
                    if ($arrive_time < $current_time) {
                        $text_type = "text-success";
                    }
                    else {
                        $text_type = "text-danger";
                    }
                @endphp
                <td class="text-center {{$text_type}}">{{date('h:i:s', $arrive_time)}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class=" container col-6 text-center">
    <a href="/trips/{{$trip->id}}/edit" type="button" class="btn btn-info py-1 px-3 my-0 rounded float-left">Sửa</a>
    <a href="/trips/{{$trip->id}}/delete" type="button" class="btn btn-danger py-1 px-3 mx-3 my-0 rounded float-left">Xóa</a>
    <a type="button" class="btn btn-primary py-1 px-3 my-0 rounded float-right" href="/trips/route/{{$route->id}}">Quay lại danh sách</a>
</div>
@endsection