@extends('layouts.admin-layout')
@section('title')
    Staffs List
@endsection
@section('header')
    Danh sách nhân viên
@endsection
@section('body')
    <div class="container col-8 my-1 p-1">
        <table class="table table-sm table-bordered table-striped table-hover">
            <thead class="thead-dark text-center">
                <tr>
                    <th>STT</th>
                    <th>Họ và tên</th>
                    <th>Giới tính</th>
                    <th>Ngày sinh</th>
                    <th>Địa chỉ</th>
                    <th>Vị trí</th>
                    <th></th>
                </tr>
            </thead>
            @foreach($staffs as $key=>$staff)
                <tr>
                    <td class="text-center align-middle">{{$key + 1}}</td>
                    <td class="pl-3 align-middle">{{$staff->name}}</td>
                    <td class="pl-3 align-middle">
                        @switch($staff->gender)
                            @case(1)
                                Nam
                                @break
                            @case(0)
                                Nữ
                                @break
                        @endswitch
                    </td>
                    <td class="pl-3 align-middle">{{date('d/m/Y',strtotime($staff->birthday))}}</td>
                    <td class="pl-3 align-middle">{{$staff->address}}</td>
                    <td class="pl-3 align-middle">
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
                    </td>
                    <td class="text-center align-middle"><a type="button" class="btn btn-primary" href="/staffs/{{$staff->id}}">Chi tiết</a></td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="container text-center my-3 p-1">
        <a type="button" class="btn btn-primary" href="/staffs/create">Thêm nhân viên</a>
    </div>
    <!-- <p id="result"></p>
    <script type="text/javascript">
        var str = ?php echo json_encode($date); ?>;
        date = new Date(str);
        document.getElementById("result").innerHTML = date;
    </script> -->
@endsection