@extends('layouts.admin-layout')
@section('title')
Add Staff
@endsection
@section('body')
<div class="container col-6 my-1 p-1">
    <form class="was-validated" method="POST">
        @csrf
        <legend>Điền thông tin nhân viên</legend>
        <div class="form-group">
            <label for="name">Họ và tên</label>
            <input type="text" class="form-control" name="name" autofocus required>
        </div>
        <div class="form-group">
            <label for="gender">Giới tính</label><br>
            <input type="radio" id="male" name="gender" value="1">
            <label for="male">Nam</label><br>
            <input type="radio" id="female" name="gender" value="0">
            <label for="female">Nữ</label><br>
        </div>
        <div class="form-group">
            <label for="birthday">Ngày sinh</label>
            <input type="date" class="form-control" name="birthday" required>
        </div>
        <div class="form-group">
            <label for="address">Địa chỉ</label>
            <input type="text" class="form-control" name="address" required>
        </div>
        <div class="form-group">
            <label for="role">Vị trí</label><br>
            <input type="radio" id="driver" name="role" value="1">
            <label for="driver">Tài xế</label><br>
            <input type="radio" id="ticketCollector" name="role" value="2">
            <label for="ticketCollector">Soát vé</label><br>
            <!-- <input type="radio" id="operator" name="role" value="3">
            <label for="operator">Điều hành viên</label><br> -->
        </div>
        <button type="submit" class="btn btn-primary">Thêm nhân viên</button>
        <a type="button" class="btn btn-primary" href="/staffs">Quay lại danh sách</a>
    </form>
</div>
@endsection