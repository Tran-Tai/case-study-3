@extends('layouts.admin-layout')
@section('title')
    Station Edit
@endsection
@section('body')
<div class="container col-6 my-1 p-1">
    <form action="/stations/{{$station->id}}" class="was-validated" method="POST">
        @method('PUT')
        @csrf
        <legend>Chỉnh sửa thông tin trạm</legend>
        <div class="form-group">
            <label for="name">Tên trạm</label>
            <input type="text" class="form-control" name="name" value="{{$station->name}}" required>
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a type="button" class="btn btn-primary" href="/stations/{{$station->id}}">Quay lại</a>
    </form>
</div>
@endsection