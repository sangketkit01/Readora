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
            <div class="form register" style="" class="form">
                <form method="post" action="{{ route('signup_insert') }}">
                    @csrf

                    <label for="username" class="form-label">ชื่อผู้ใช้</label>
                    <input type="text" name="username" placeholder="ชื่อผู้ใช้" value="{{old('username')}}" class="form-control" required>
                    @if ($errors->has('username'))
                        <p class="mt-2 mb-0 text-danger fw-bold" style="font-size: 14px; margin-left:2px">{{$errors->first('username')}}</p>
                    @endif

                    <label for="email" class="form-label mt-3">อีเมลล์</label>
                    <input type="email" name="email" placeholder="อีเมลล์" value="{{old('email')}}" class="form-control"  required>
                    @if ($errors->has('email'))
                        <p class="mt-2 mb-0 text-danger fw-bold" style="font-size: 14px; margin-left:2px">{{$errors->first('email')}}</p>
                    @endif

                    <label for="password" class="form-label mt-3">รหัสผ่าน</label>
                    <input type="password" min="8" name="password" placeholder="รหัสผ่าน" id="password-input" class="form-control"  required>
                    <p class="mt-2 mb-0 text-danger fw-bold" id="password-p" style="font-size: 14px; margin-left:2px">รหัสผ่านต้องมีขั้นต่ำ 8 ตัวอักษร</p>

                    <label for="confirm" class="form-label mt-3">ยืนยันรหัสผ่าน</label>
                    <input type="password" name="confirm" placeholder="ยืนยันรหัสผ่าน" id="confirm-password-input" class="form-control" required>
                    <p class="mt-2 mb-0 text-danger fw-bold" id="confirm-p" style="font-size: 14px; margin-left:2px">รหัสผ่านไม่ตรงกัน</p>

                    <label for="gender" class="form-label mt-3">เพศ</label>
                    <select name="gender"  class="form-control">
                        <option value="N">ไม่ระบุ</option>
                        <option value="M">ชาย</option>
                        <option value="F">หญิง</option>
                    </select>
                    <button type="submit" class="btn mt-4" id="register-button">สมัครสมาชิก</button>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="{{asset('js/login/sign_up.js')}}"></script>
</html>
