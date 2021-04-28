@extends('layouts.admin-layout')
@section('title')
bus Info
@endsection
@section('body')
<div class="container col-6 my-1 p-1">
    <form>
        <legend>Thông tin xe</legend>
        <div class="form-group">
            <label for="number">Biển số xe</label>
            <p class="form-control">{{$bus->number}}</p>
        </div>
        <div class="form-group">
            <label for="seat">Số ghế</label><br>
            <p class="form-control col-4">{{$bus->seat}}</p>
        </div>
        <div class="form-group">
            <label for="capacity">Số hành khách tối đa</label><br>
            <p class="form-control col-4">{{$bus->capacity}}</p>
        </div>
        <div class="form-group">
            <label for="route_id">Tuyến đi</label><br>
            <p class="form-control col-6">Tuyến số {{$route1->number}}: {{$route1->name}}</p>
        </div>
        <div class="form-group">
            <label for="route_id">Tuyến về</label><br>
            <p class="form-control col-6">Tuyến số {{$route2->number}}: {{$route2->name}}</p>
        </div>
    </form>
</div>
<div class="text-center container col-6"><a href="/buses/{{$bus->id}}/edit"
                                type="button" 
                                class="btn btn-info py-1 px-3 my-0 rounded float-left">Sửa</a> 
                            <a href="/buses/{{$bus->id}}/delete"
                                type="button" 
                                class="btn btn-danger py-1 px-3 mx-5 my-0 rounded float-left">Xóa</a>
                            <a href="/buses" 
                                type="button" 
                                class="btn btn-primary py-1 px-3 my-0 rounded float-right">Quay lại danh sách</a>
</div>
@endsection