@extends('layouts.admin-layout')
@section('title')
Add Trips
@endsection
@section('body')
<div class="container col-6 my-1 p-1">
    <form class="was-validated" method="POST">
        @csrf
        <legend>Điền thông tin chuyến</legend>
        <div class="form-group">
            <label for="name">Tuyến</label>
            <input id="route_id" type="number" name="route_id" value="{{$route->id}}" hidden>
            <p class="form-control" >Số {{$route->number}}: {{$route->name}}, 
                @switch($route->direction)
                    @case(1)
                        tuyến đi
                        @break
                    @case(2)
                        tuyến về
                        @break
                @endswitch
            </p>
        </div>
        <div class="form-group">
            <label for="date">Ngày</label>
            <input id="date" type="date" class="form-control" name="date" required onblur="getAvailable()">
        </div>
        <div class="form-group">
            <label for="time">Thời gian khởi hành</label> <br>
            <input id="start_hour" type="number" name="start_hour" min="00" max="23" value="00" required onchange="calculateTime()">
            :
            <input id="start_minute" type="number" name="start_minute" min="0" max="59" value="00" required onchange="calculateTime()">
            :
            <input id="start_second" type="number" name="start_second" min="0" max="59" value="00" required onchange="calculateTime()">
        </div>
        <div class="form-group">
            <label for="time">Thời gian kết thúc</label> <br>
            <input id="end_hour" type="number" name="end_hour" min="0" max="23" value="00" readonly>
            :
            <input id="end_minute" type="number" name="end_minute" min="0" max="59" value="00" readonly>
            :
            <input id="end_second" type="number" name="end_second" min="0" max="59" value="00" readonly>
        </div>
        <div id="getData">
            
        </div>
        <button type="submit" class="btn btn-primary">Thêm chuyến</button>
        <a type="button" class="btn btn-primary" href="/routes">Quay lại danh sách</a>
    </form>
</div>
<script>

    function calculateTime() {
        hour = document.getElementById("start_hour").value;
        minute = document.getElementById("start_minute").value;
        second = document.getElementById("start_second").value;
        time = (hour * 3600) + (minute * 60) + (second * 1);
        time = time + <?php echo $route->total_time ;?>;
        
        second = time % 60;
        time_in_minute = (time - second) / 60;
        minute = time_in_minute % 60;
        hour = (time_in_minute - minute) / 60;

        if (second < 10) second = "0" + second;
        if (minute < 10) minute = "0" + minute;
        if (hour < 10) hour = "0" + hour;

        document.getElementById("end_hour").value = hour;
        document.getElementById("end_minute").value = minute;
        document.getElementById("end_second").value = second;
        getAvailable();
    }

    function getAvailable() {
        route_id = document.getElementById("route_id").value;
        date = document.getElementById("date").value;
        hour = document.getElementById("start_hour").value;
        minute = document.getElementById("start_minute").value;
        second = document.getElementById("start_second").value;
        const data = {
            _token: document.querySelector(`[name="_token"]`).value,
            route_id: route_id,
            date: date,
            hour: hour,
            minute: minute,
            second: second
        }
        console.log(data);

        $.ajax({
            url: '/trips/getInfo',
            type: 'POST',
            data: data,
            success: function(xml) {
                console.log(xml);
                document.getElementById("getData").innerHTML = xml;
            },
            error: function() {
                alert("Get Failed");
            }
        })
    }
</script>
@endsection