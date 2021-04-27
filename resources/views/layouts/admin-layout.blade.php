<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-grid.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @yield('addCSS')
</head>
<body>
    <nav class="navbar navbar-dark bg-light">
        <!-- <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" 
                data-target="#navbarSupportedContent" 
                aria-controls="navbarSupportedContent" 
                aria-expanded="false" 
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> -->

        <ul class="mx-auto nav nav-pills">
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('staffs*')) ? 'active' : '' }}" href="/staffs">Staffs</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('stations*')) ? 'active' : '' }}" href="/stations">Stations</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('routes*')) ? 'active' : '' }}" href="/routes">Routes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('buses*')) ? 'active' : '' }}" href="/buses">Buses</a>
            </li>
        </ul>



        <form method="POST" action="/sign-out">
            @csrf
            <button type="submit" class="btn btn-secondary btn-sm">Sign Out</button>
        </form>
    </nav>
    <div class="text-center">
        <h1>@yield('header', '')</h1>
    </div>
    @yield('body')
</body>
</html>