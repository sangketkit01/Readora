<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/layout.css">
    @stack('style')
</head>
<body>
    <div class="navbar">
        <div class="left-menu">
            <a href="#">นิยาย</a>
            <a href="#">คอมมิค</a>
        </div>
        <div class="web-title">
            <a href="/" id="title">เอาชื่อเว็บมาใส่</a>
        </div>
        <div class="right-menu">
            <a href="#"><img src="/nav/search.png" alt=""></a>
            <a href="#"><img src="/nav/pen.png" alt=""></a>
            <a href="#"><img src="/nav/profile.png" alt=""></a>
        </div>
    </div>
</body>
</html>