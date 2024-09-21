<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/user/navtest.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <nav>
            <div class="logo">
                <h1>LOGO</h1>
                <ul>
                    <li><a href="">นิยาม</a></li>
                    <li><a href="">คอมมิก</a></li>
                </ul>
            </div>
            <div class="search_main">
                <a href="" class="search"><i class="fa-solid fa-magnifying-glass"></i></a>
                <a href="" class="button">
                    ลงชื่อเข้าใช้
                </a>
            </div>
    </div>
    </nav>
    </div>
    @yield('content')
</body>

</html>