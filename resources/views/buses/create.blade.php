@extends('layouts.admin-layout')
@section('title')
Add Staff
@endsection
@section('body')
<div class="container col-6 my-1 p-1">
    <form class="was-validated" method="POST">
        @csrf
        <legend>Điền thông tin xe</legend>
        <div class="form-group">
            <label for="number">Biển số xe</label>
            <input type="text" class="form-control" name="number" autofocus required>
        </div>
        <div class="form-group">
            <label for="seat">Số ghế</label><br>
            <input type="number" class="form-control col-4" name="seat" required>
        </div>
        <div class="form-group">
            <label for="capacity">Số hành khách tối đa</label><br>
            <input type="number" class="form-control col-4" name="capacity" required>
        </div>
        <div class="form-group">
            <label for="route_id">Tuyến đi</label><br>
            <select class="form-control col-6" name="route_id1">
            @foreach($routes as $route)
                @if ($route->direction == 1)
                <option value="{{$route->id}}">Tuyến số {{$route->number}}: {{$route->name}}</option>
                @endif
            @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="route_id">Tuyến về</label><br>
            <select class="form-control col-6" name="route_id2">
            @foreach($routes as $route)
                @if ($route->direction == 2)
                <option value="{{$route->id}}">Tuyến số {{$route->number}}: {{$route->name}}</option>
                @endif
            @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Thêm thông tin</button>
        <a type="button" class="btn btn-primary" href="/buses">Quay lại danh sách</a>
    </form>
</div>
@endsection