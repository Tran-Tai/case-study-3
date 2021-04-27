@extends('layouts.admin-layout')
@section('title')
    Bus Edit
@endsection
@section('body')
<div class="container col-6 my-1 p-1">
    <form action="/buses/{{$bus->id}}" class="was-validated" method="POST">
        @method('PUT')
        @csrf
        <legend>Chỉnh sửa thông tin xe</legend>
        <div class="form-group">
            <label for="number">Biển số xe</label>
            <input type="text" class="form-control" name="number" value="{{$bus->number}}" required>
        </div>
        <div class="form-group">
            <label for="seat">Số ghế</label><br>
            <input type="number" name="seat" value="{{$bus->seat}}" required>
        </div>
        <div class="form-group">
            <label for="capacity">Số hành khách tối đa</label><br>
            <input type="number" name="capacity" value="{{$bus->capacity}}" required>
        </div>
        <div class="form-group">
            <label for="route_id">Tuyến đi</label><br>
            <select name="route_id1">
            @foreach($routes as $route)
                @if ($route->direction == 1)
                <option value="{{$route->id}}" 
                    @if ($bus->route_id1 == $route->id)
                        selected
                    @endif
                >Tuyến số {{$route->number}}: {{$route->name}}</option>
                @endif
            @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="route_id">Tuyến về</label><br>
            <select name="route_id2">
            @foreach($routes as $route)
                @if ($route->direction == 2)
                <option value="{{$route->id}}"
                    @if ($bus->route_id2 == $route->id)
                        selected
                    @endif
                >Tuyến số {{$route->number}}: {{$route->name}}</option>
                @endif
            @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Lưu thông tin</button>
        <a type="button" class="btn btn-primary" href="/buses">Quay lại danh sách</a>
    </form>
</div>
@endsection