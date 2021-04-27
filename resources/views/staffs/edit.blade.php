@extends('layouts.admin-layout')
@section('title')
    Staff Edit
@endsection
@section('body')
<div class="container col-6 my-1 p-1">
    <form action="/staffs/{{$staff->id}}" class="was-validated" method="POST">
        @method('PUT')
        @csrf
        <legend>Chỉnh sửa thông tin nhân viên</legend>
        <div class="form-group">
            <label for="name">Họ và tên</label>
            <input type="text" class="form-control" name="name" value="{{$staff->name}}" required>
        </div>
        <div class="form-group">
            <label for="gender">Giới tính</label><br>
            <input type="radio" id="male" name="gender" value="1" 
                @if (@$staff->gender == 1)
                    checked
                @endif
            >
            <label for="male">Nam</label><br>
            <input type="radio" id="female" name="gender" value="0"
                @if (@$staff->gender == 0)
                    checked
                @endif
            >
            <label for="female">Nữ</label><br>
        </div>
        <div class="form-group">
            <label for="birthday">Ngày sinh</label>
            <input type="date" class="form-control" name="birthday" value="{{$staff->birthday}}" required>
        </div>
        <div class="form-group">
            <label for="address">Địa chỉ</label>
            <input type="text" class="form-control" name="address" value="{{$staff->address}}" required>
        </div>
        <div class="form-group">
            <label for="role">Vị trí</label><br>
            <input type="radio" id="driver" name="role" value="1"
                @if (@$staff->role_code == 1)
                    checked
                @endif
            >
            <label for="driver">Tài xế</label><br>
            <input type="radio" id="ticketCollector" name="role" value="2"
                @if (@$staff->role_code == 2)
                    checked
                @endif
            >
            <label for="ticketCollector">Soát vé</label><br>
            <input type="radio" id="operator" name="role" value="3"
                @if (@$staff->role_code == 3)
                    checked
                @endif
            >
            <label for="operator">Điều phối viên</label><br>
        </div>
        <button type="submit" class="btn btn-primary">Lưu thông tin</button>
        <a type="button" class="btn btn-primary" href="/staffs/{{$staff->id}}">Quay lại</a>
    </form>
</div>
@endsection