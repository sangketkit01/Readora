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
    @stack('style')
</head>

<body style="background-color: #F1F1F1; margin-bottom:20px;">
    <div class="navbar-layout">
        <div class="left-menu">
            <a href="/" id="title">เอาชื่อเว็บมาใส่</a>
            <a href="#">นิยาย</a>
            <a href="#">คอมมิค</a>
        </div>
        <div class="right-menu">
            <form action="/search" method="GET" class="search-form">
                <input type="text" name="query" placeholder="ค้นหา..." class="search-input">
                <button type="submit" class="search-button"><img src="/nav/search.svg" width="20" height="20"
                        alt=""></button>
            </form>
            @if (session()->has('user'))
                <div class="dropdown">
                    <a class="dropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if (session('user')->profile == null)
                            <img src="{{ asset('novel/midoriya.png') }}" id="avatar-picture" alt="">
                        @else
                            <img src="{{ session('user')->profile }}" id="avatar-picture" alt="">
                        @endif
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('create_novel') }}">สร้างคอมมิค</a></li>
                        <li><a class="dropdown-item" href="{{ route('create_comic') }}">สร้างนิยาย</a></li>
                        <li><a class="dropdown-item" href="{{ route('sign_out') }}">Logout</a></li>
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
        setup: function(editor) {
            editor.on('init', function() {
                editor.execCommand('mceInsertContent', false, '<p style="text-align: left;"></p>');
            });
        },
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
