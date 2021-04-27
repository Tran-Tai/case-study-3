@extends('layouts.admin-layout')
@section('title')
Staff Info
@endsection
@section('body')
<div class="container col-6 my-1 p-1">
    <form>
        <legend>Thông tin nhân viên</legend>
        <div class="form-group">
            <label>Họ và tên</label>
            <p class="form-control">{{$staff->name}}</p>
        </div>
        <div class="form-group">
            <label>Giới tính</label>
            <p class="form-control">
                @switch($staff->gender)
                    @case(1)
                        Nam
                        @break
                    @case(0)
                        Nữ
                        @break
                @endswitch
            </p>
        </div>
        <div class="form-group">
            <label">Ngày sinh</label>
            <p class="form-control">{{$staff->birthday}}</p>
        </div>
        <div class="form-group">
            <label>Địa chỉ</label>
            <p class="form-control">{{$staff->address}}</p>
        </div>
        <div class="form-group">
            <label>Vị trí</label><br>
            <p class="form-control">
                @switch($staff->role_code)
                    @case(1)
                        Lái xe
                        @break
                    @case(2)
                        Soát vé
                        @break
                    @case(3)
                        Điều phối viên
                        @break
                @endswitch
            </p>
        </div>
    </form>
</div>
<div class="text-center container col-6"><a href="/staffs/{{$staff->id}}/edit"
                                type="button" 
                                class="btn btn-info py-1 px-3 my-0 rounded float-left">Sửa</a> 
                            <a href="/staffs/{{$staff->id}}/delete"
                                type="button" 
                                class="btn btn-danger py-1 px-3 mx-5 my-0 rounded float-left">Xóa</a>
                            <a href="/staffs" 
                                type="button" 
                                class="btn btn-primary py-1 px-3 my-0 rounded float-right">Quay lại danh sách</a>
</div>
@endsection