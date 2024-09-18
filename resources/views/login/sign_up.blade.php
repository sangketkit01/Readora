<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign up</title>
    <link rel="stylesheet" href="/css/login/sign_in.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <div class="container1">
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
                    @if ($errors->has('username'))
                        <p class="mt-2 mb-0 text-danger" style="font-size: 14px; margin-left:2px">{{$errors->first('username')}}</p>
                    @endif
                    <label for="email">อีเมลล์</label>

                    @if (session()->has('google_email'))
                        <input type="email" name="email" value="{{ session('google_email') }}">
                    @else
                        <input type="email" name="email" placeholder="อีเมลล์" required>
                         @if ($errors->has('email'))
                            <p class="mt-2 mb-0 text-danger" style="font-size: 14px; margin-left:2px">{{$errors->first('email')}}</p>
                        @endif
                    @endif
                    <label for="password">รหัสผ่าน</label>
                    <input type="password" name="password" placeholder="รหัสผ่าน" id="password-input" required>
                    <p class="mt-2 mb-0 text-danger" id="password-p" style="font-size: 14px; margin-left:2px">รหัสผ่านต้องมีขั้นต่ำ 8 ตัวอักษร</p>
                    <label for="confirm">ยืนยันรหัสผ่าน</label>
                    <input type="password" name="confirm" placeholder="ยืนยันรหัสผ่าน" id="confirm-password-input" required>
                    <p class="mt-2 mb-0 text-danger" id="confirm-p" style="font-size: 14px; margin-left:2px">รหัสผ่านไม่ตรงกัน</p>
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
<script src="{{asset('js/login/sign_up.js')}}"></script>
</html>
