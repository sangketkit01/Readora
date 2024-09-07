<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign in</title>
    <link rel="stylesheet" href="/css/login/sign_in.css">
</head>
<body>
    <div class="container">
        <div class="cover">
            <img src="/login/login.png" id="login-cover" alt="">
        </div>
        <div class="elements">
            <div class="header">
                <div class="text">
                    <a href="{{route('sign_in')}}">เข้าสู่ระบบ</a>
                    <a href="{{route('sign_up')}}" style="color:#AEAEAE;">สร้างบัญชี</a>
                </div>
                <div class="line">
                    <div class="line1" ></div>
                    <div class="line2" style="color: #AEAEAE"></div>
                </div>
            </div>
            <div class="form login">
                <form action="{{route('login_verify')}}" method="POST">
                    @csrf
                    <label for="username">Username</label>
                    <input type="text" name="username" placeholder="Username" required>
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Password" required>
                    <a href="#" id="forgot">ลืมรหัสผ่าน?</a>
                    <button type="submit" id="login-button">เข้าสู่ระบบ</button>
                    <div class="or">
                        <div class="line"></div>
                        <label for="or" id="or-text">หรือ</label>
                        <div class="line"></div>
                    </div>

                    <div class="third-party-login">
                        <a href="{{route('google-auth')}}" type="button" id="google"><img src="/login/Google.png" alt="" id="google-img"> เข้าสู่ระบบด้วย Google</a>
                        <a href="#" type="button" id="facebook">เข้าสู่ระบบด้วย Facebook</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>