<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('css/admin/login.css')}}">
</head>
<body>
    <div class="container">
        <img src="{{asset('admin/login.png')}}" alt="">

        <div class="login-form">
            <form action="{{route('admin.login_verify')}}" method="POST">
                @csrf
                <h2>Admin</h2>
                <div class="login-content">
                    <label for="username">Username</label>
                    <input type="text" placeholder="Username" name="username">
                    <label for="password">Password</label>
                    <input type="password" placeholder="Password" name="password">
                    <input type="submit" value="เข้าสู่ระบบ" id="submit-button">
                </div>
            </form>

            <label for="" id="problem">มีปัญหาติดต่อ example@hotmail.com</label>
        </div>
    </div>
</body>
</html>