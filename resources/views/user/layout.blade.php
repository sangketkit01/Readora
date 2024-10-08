<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/user/layout.css">
    <link rel="stylesheet" href="/css/user/search.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @stack('style')
</head>

<body style="background-color: #F1F1F1; margin-bottom:20px;">
    <div class="navbar-layout">
        <div class="left-menu">
            <a href="/" id="title">Readora</a>
            <a href="{{ route('index.rec1') }}">แนะนำนิยาย</a>
            <a href="{{ route('index.rec2') }}">แนะนำคอมมิค</a>
        </div>
        <div class="right-menu">
            <form action="{{route('search')}}" method="GET" class="search-form">
                <input type="text" name="query" placeholder="ค้นหา..." class="search-input">
                <button type="submit" class="search-button"><img src="/nav/search.svg" width="20" height="20"
                        alt=""></button>
            </form>
            @if (session()->has('user'))
                <div class="dropdown">
                    <a class="dropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset(session('user')->profile) }}" style="object-fit: cover" id="avatar-picture" alt="">
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('profile') }}">โปรไฟล์</a></li>
                        <li><a class="dropdown-item" href="{{ route('profile.novel') }}">นิยายของฉัน</a></li>
                        <li><a class="dropdown-item" href="{{ route('profile.comic') }}">คอมมิคของฉัน</a></li>
                        <li><a class="dropdown-item" href="{{ route('index.book_shelve') }}">ชั้นหนังสือของฉัน</a></li>
                        <li><a class="dropdown-item" href="{{ route('create_novel') }}">สร้างนิยาย</a></li>
                        <li><a class="dropdown-item" href="{{ route('create_comic') }}">สร้างคอมมิค</a></li>
                        <li><a class="dropdown-item" href="{{ route('sign_out') }}">ออกจากระบบ</a></li>
                    </ul>
                </div>
            @else
                <a href="{{ route('sign_in') }}" id="login-button">ลงชื่อเข้าใช้</a>
            @endif

        </div>
    </div>

    <div class="@yield('containerClassName')">
        @yield('content')
    </div>


</body>
@stack('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.tiny.cloud/1/zhehvkk9eiqyglv55vqlvab85y9f4f3j86swwbmx496wzw13/tinymce/7/tinymce.min.js"
    referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '.ck',
        formats: {
            alignleft: {
                selector: 'p,h1,h2,h3,h4,h5,h6',
                styles: {
                    'text-align': 'left'
                }
            }
        },
        content_style: "p { text-align: left; }",
    });
</script>

</html>
