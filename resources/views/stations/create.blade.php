@extends('layouts.admin-layout')
@section('title')
Stations Create
@endsection
@section('body')
<div class="container col-6 my-1 p-1">
    <form class="was-validated" method="POST">
        @csrf
        <legend>Điền thông tin trạm</legend>
        <div class="form-group">
            <label for="name">Tên trạm</label>
            <input type="text" class="form-control" name="name" autofocus required>
        </div>
        <button type="submit" class="btn btn-primary">Thêm trạm</button>
        <a type="button" class="btn btn-primary" href="/stations">Quay lại danh sách</a>
    </form>
</div>
@endsection