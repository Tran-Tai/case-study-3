@extends('layouts.admin-layout')
@section('title')
    Route Edit
@endsection
@section('body')
<div class="container col-6 my-1 p-1">
    <form action="/routes/{{$route->id}}" class="was-validated" method="POST">
        @method('PUT')
        @csrf
        <legend>Chỉnh sửa thông tin tuyến</legend>
        <div class="form-group">
            <label for="number">Số tuyến</label>
            <input type="number" class="form-control" name="number" value="{{$route->number}}" required>
        </div>
        <div class="form-group">
            <label for="name">Tên tuyến</label>
            <input type="text" class="form-control" name="name" value="{{$route->name}}" required>
        </div>
        <div class="form-group">
            <label for="direction">Hướng đi</label><br>
            <input type="radio" id="leave" name="direction" value="1"
                @if($route->direction == 1)
                    checked
                @endif
            >
            <label for="leave">Tuyến đi</label><br>
            <input type="radio" id="back" name="direction" value="2"
                @if($route->direction == 2)
                    checked
                @endif
            >
            <label for="female">Tuyến về</label><br>
        </div>
        <div class="form-group">
            <label for="total_station">Tổng số trạm</label>
            <input id="number" type="number" class="form-control" name="total_station" value="{{$route->total_station}}" readonly>
        </div>
        <div class="form-group">
            <label for="time">Thời gian hành trình</label> <br>
            @php
                $time = $route->total_time;
                $second = $time % 60;
                $time_in_minute = ($time - $second) / 60;
                $minute = $time_in_minute % 60;
                $hour = ($time_in_minute - $minute) / 60;

                if ($second < 10) $second = "0" . $second;
                if ($minute < 10) $minute = "0" . $minute;
                if ($hour < 10) $hour = "0" . $hour;
            @endphp
            <input type="number" name="time_hour" min="0" max="23" value="{{$hour}}" readonly>
            :
            <input type="number" name="time_minute" min="0" max="59" value="{{$minute}}" readonly>
            :
            <input type="number" name="time_second" min="0" max="59" value="{{$second}}" readonly>
        </div>
        <div class="form-group">
            <label for="time_interval">Thời gian giãn cách</label> <br>
            @php
                $time = $route->time_interval;
                $second = $time % 60;
                $time_in_minute = ($time - $second) / 60;
                $minute = $time_in_minute % 60;
                $hour = ($time_in_minute - $minute) / 60;

                if ($second < 10) $second = "0" . $second;
                if ($minute < 10) $minute = "0" . $minute;
                if ($hour < 10) $hour = "0" . $hour;
            @endphp
            <input type="number" name="time_interval_hour" min="0" max="23" value="{{$hour}}" readonly>
            :
            <input type="number" name="time_interval_minute" min="0" max="59" value="{{$minute}}" readonly>
            :
            <input type="number" name="time_interval_second" min="0" max="59" value="{{$second}}" readonly>
        </div>
        <button id="submit" type="submit" class="btn btn-primary">Lưu thông tin tuyến</button>
        <a type="button" class="btn btn-primary" href="/routes">Quay lại danh sách</a>
    </form>
</div>
@endsection