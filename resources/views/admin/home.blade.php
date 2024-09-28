<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('css/admin/navigator.css') }}">
    @stack('style')
    <link rel="stylesheet" href="{{ asset('css/admin/mainpage.css') }}">
    
</head>
<body>
    <div class="navbar">
        <div class="nav">
            <ul>
                <li class="left">เอาชื่อเวปมาใส่</li>
                <li class="right"><img src="https://static.vecteezy.com/system/resources/thumbnails/019/879/186/small_2x/user-icon-on-transparent-background-free-png.png" alt="profile" width="35px"></li>
                <li class="right"><a href="#"></a>Dashboard</li>
                <li class="right"><a href="#"></a>Support</li>
                <li class="right"><a href="#"></a>Home</li>
            </ul>
        </div>
    </div>
    
    <div class="container">
        @yield('content')
    </div>

    @yield('additional_js')
</body>
</html>
