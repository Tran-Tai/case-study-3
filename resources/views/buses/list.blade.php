@extends('layouts.admin-layout')
@section('title')
    Buses List
@endsection
@section('header')
    Danh sách xe
@endsection
@section('body')
    <div class="container col-8 my-1 p-1">
        <table class="table table-sm table-bordered table-striped table-hover">
            <thead class="thead-dark text-center">
                <tr>
                    <th>STT</th>
                    <th>Số xe</th>
                    <th>Số ghế</th>
                    <th>Số hành khách tối đa</th>
                    <th>Số tuyến</th>
                    <th></th>
                </tr>
            </thead>
            @foreach($buses as $key=>$bus)
                <tr>
                    <td class="text-center align-middle">{{$key + 1}}</td>
                    <td class="pl-3 align-middle">{{$bus->number}}</td>
                    <td class="pl-3 align-middle">{{$bus->seat}}</td>
                    <td class="pl-3 align-middle">{{$bus->capacity}}</td>
                    <td class="pl-3 align-middle">{{$bus->route_id1}}</td>
                    <td class="text-center align-middle"><a type="button" class="btn btn-primary" href="/buses/{{$bus->id}}">Chi tiết</a></td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="container text-center my-3 p-1">
        <a type="button" class="btn btn-primary" href="/buses/create">Thêm thông tin xe mới</a>
    </div>
@endsection