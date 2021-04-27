@extends('layouts.admin-layout')
@section('title')
    Station Info
@endsection
@section('body')
    <div class="container col-6 my-1 p-1">
        <form>
            <div class="form-group">
                <label>ID</label>
                <p class="form-control">{{$station->id}}</p>
                <label>Tên trạm</label>
                <p class="form-control">{{$station->name}}</p>
        </form>
    </div>
    <div class="text-center"><a href="/stations/{{$station->id}}/edit"
                                    type="button" 
                                    class="btn btn-info py-1 px-3 my-0 rounded float-left">Sửa</a> 
                                <a href="/stations/{{$station->id}}/delete"
                                    type="button" 
                                    class="btn btn-danger py-1 px-3 mx-3 my-0 rounded float-left">Xóa</a>
                                <a type="button" 
                                    class="btn btn-primary py-1 px-3 my-0 rounded float-right" 
                                    href="/stations">Quay lại danh sách</a>
    </div>
@endsection