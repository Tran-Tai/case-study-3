@extends('layouts.admin-layout')
@section('title')
Add Route
@endsection
@section('addCSS')
<style>
    .dropdown-content {
        width: 200px;
        overflow: auto;
        z-index: 1;
    }

    option:hover {
        background-color: #ddd;
    }

    .search {
        width: 192px;
    }
</style>
@endsection
@section('body')
<div class="container col-6 my-1 p-1">
    <form class="was-validated" method="POST">
        @csrf
        <legend>Điền thông tin tuyến</legend>
        <div class="form-group">
            <label for="number">Số tuyến</label>
            <input type="number" class="form-control" name="number" autofocus required>
        </div>
        <div class="form-group">
            <label for="name">Tên tuyến</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label for="direction">Hướng đi</label><br>
            <input type="radio" id="leave" name="direction" value="1">
            <label for="leave">Tuyến đi</label><br>
            <input type="radio" id="back" name="direction" value="2">
            <label for="female">Tuyến về</label><br>
        </div>
        <div class="form-group">
            <label for="total_station">Tổng số trạm</label>
            <input id="number" type="number" class="form-control" name="total_station" onchange="insertTable()" required>
        </div>
        <div class="form-group">
            <label for="time">Thời gian hành trình</label> <br>
            <input type="number" name="time_hour" min="0" max="23" value="00" required>
            :
            <input type="number" name="time_minute" min="0" max="59" value="00" required>
            :
            <input type="number" name="time_second" min="0" max="59" value="00" required>
        </div>
        <div class="form-group">
            <label for="time_interval">Thời gian giãn cách</label> <br>
            <input type="number" name="time_interval_hour" min="0" max="23" value="00" required>
            :
            <input type="number" name="time_interval_minute" min="0" max="59" value="00" required>
            :
            <input type="number" name="time_interval_second" min="0" max="59" value="00" required>
        </div>
        <div class="container my-1 p-1">
            <label>Thông tin các trạm</label><br>
            <input type="number" name="time_minute1" value="0" hidden>
            <input type="number" name="time_second1" value="0" hidden>
            <table class="table table-sm table-bordered">
                <thead class="thead-dark text-center">
                    <tr>
                        <th class="align-middle">STT</th>
                        <th class="align-middle">Số trạm</th>
                        <th class="align-middle">Tên trạm</th>
                        <th class="align-middle">Thời gian đến trạm tiếp theo</th>
                    </tr>
                </thead>
                <tbody id="tb" class="text-center">
                </tbody>
            </table>
        </div>
        <button id="submit" type="submit" class="btn btn-primary">Thêm tuyến</button>
        <a type="button" class="btn btn-primary" href="/routes">Quay lại danh sách</a>
    </form>
</div>
<script>
    function insertTable() {
        rows = document.getElementById("tb").getElementsByTagName("tr");
        for (let i = rows.length - 1; i >= 0; i--) {
            rows[i].remove();
        }
        rows_number = document.getElementById("number").value;
        for (let i = 1; i <= rows_number; i++) {
            insertRow(i, rows_number);
        }
    }

    function insertRow(number, rows_number) {
        var newlement = document.createElement("tr");
        newlement.setAttribute("id", "row" + number);
        document.getElementById("tb").appendChild(newlement);
        insertDisable = 'value="00"';
        if (number == rows_number) insertDisable = "disabled";
        var text = '<td>' + number + '</td>' +
            '<td><input type="number" name="station_number' + number + '"></td>' +
            '<td>' +
            '<div id="dropdown' + number + '" class="dropdown-content">' +
            '<input class="search" type="text" id="search' + number + '" placeholder="search for station" onkeyup="filterFunction(' + number + ')">' +
            '</div>' +
            '<input type="number" id="station' + number + '" name="station_id' + number + '" hidden required>' +
            '</td>' +
            '<td>' +
            '<input type="number" name="time_minute' + (number + 1) + '" min="0" max="59" ' + insertDisable + '>' +
            ' : ' +
            '<input type="number" name="time_second' + (number + 1) + '" min="0" max="59" ' + insertDisable + '>' +
            '</td>';
        document.getElementById("row" + number).innerHTML = text;
    }

    function filterFunction(number) {
        var input, filter, option, ul, i, array;
        var stations = <?php if(isset($stations)) echo json_encode($stations); ?>;
        input = document.getElementById("search" + number);
        filter = input.value.toUpperCase();
        div = document.getElementById("dropdown" + number);

        option = div.getElementsByTagName("option");
        for (i = option.length - 1; i >= 0; i--) {
            option[i].remove();
        }
        if (filter.length > 0) {
            for (i = 0; i < stations.length; i++) {
                txtValue = stations[i].name;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    var newlement = document.createElement("option");
                    newlement.setAttribute("value", stations[i].id);
                    newlement.setAttribute("onclick", "save(" + number + ", this.innerHTML, this.value)");
                    newlement.innerHTML = stations[i].name;

                    div.appendChild(newlement);
                }
            }
        }
    }

    function save(number, text, id) {
        document.getElementById("search" + number).value = text;
        document.getElementById("station" + number).value = id;
        let option = div.getElementsByTagName("option");
        for (i = option.length - 1; i >= 0; i--) {
            option[i].remove();
        }
    }

    document.addEventListener("keydown", function(event) {
        if (event.keyCode == 13) event.preventDefault();
    });
</script>
@endsection