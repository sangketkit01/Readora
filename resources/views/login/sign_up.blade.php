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
                    <a href="{{route('sign_in')}}" style="color:#AEAEAE;">เข้าสู่ระบบ</a>
                    <a href="{{route('sign_up')}}">สร้างบัญชี</a>
                </div>
                <div class="line">
                    <div class="line1" style="color:#AEAEAE;"></div>
                    <div class="line2"></div>
                </div>
            </div>
            <div class="form register" style="">
                <form method="post" action="{{ route('signup_insert') }}">
                    @csrf
                    <label for="username">ชื่อผู้ใช้</label>
                    <input type="text" name="username" placeholder="ชื่อผู้ใช้" required>
                    <label for="email">อีเมลล์</label>

                    @if (session()->has('google_email'))
                        <input type="email" name="email" value="{{ session('google_email') }}">
                    @else
                        <input type="email" name="email" placeholder="อีเมลล์" required>
                    @endif
                    <label for="password">รหัสผ่าน</label>
                    <input type="password" name="password" placeholder="รหัสผ่าน" required>
                    <label for="confirm">ยืนยันรหัสผ่าน</label>
                    <input type="password" name="confirm" placeholder="ยืนยันรหัสผ่าน" required>
                    <label for="gender">เพศ</label>
                    <select name="gender" class="gender">
                        <option value="none">ไม่ระบุ</option>
                        <option value="m">ชาย</option>
                        <option value="f">หญิง</option>
                    </select>
                    <button type="submit" id="register-button">สมัครสมาชิก</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
