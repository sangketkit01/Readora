<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/user/layout.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @stack('style')
</head>

<body style="background-color: #F1F1F1">
    <div class="navbar">
        <div class="left-menu">
            <a href="#" id="title">เอาชื่อเว็บมาใส่</a>
            <a href="#">นิยาย</a>
            <a href="#">คอมมิก</a>
        </div>
        <div class="right-menu">
            <button><img src="/nav/search.png" alt=""></button>
            @if (session()->has('user'))
                <div class="dropdown">
                    <a class="dropdown" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img src="{{session('user')->profile}}" id="avatar-picture" alt="">
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="{{route('sign_out')}}">Logout</a></li>
                    </ul>
                </div>
            @else
                <a href="{{route('sign_in')}}" id="login-button">ลงชื่อเข้าใช้</a>
            @endif

        </div>
    </div>

    <div class="@yield('containerClassName')">
        @yield('content')
    </div>

    
</>
@stack('scripts')

</html>
