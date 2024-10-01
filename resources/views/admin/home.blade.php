<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('css/admin/navigator.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/admin/mainpage.css') }}"> --}}
    @stack('style')

</head>

<body>
    <div class="navbar">
        <div class="nav">
            <ul>
                <li class="left">Readora</li>
                <li class="right"><a href="{{ route('Home_admin') }}">Dashboard</a></li>
            </ul>
        </div>
    </div>

    <div class="@yield('containerClassName')">
        @yield('content')
    </div>


</body>
@stack('scripts')

</html>
