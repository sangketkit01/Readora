@extends('user.layout')
@section('content')
    <h5>เปลี่ยนรหัสผ่าน</h5>
    <form action="" method="post" id="update-password-form">
        @csrf
        <label for="current_password">รหัสผ่านเดิม
            <input type="password" name="current_password" id="" required>
        </label> <br>
        <label for="new_password">รหัสผ่านใหม่
            <input type="password" name="new_password" id="" required>
        </label> <br>
        <label for="confirm_password">ยืนยันรหัสผ่าน
            <input type="password" name="confirm_password" id="" required>
        </label> <br>
        <button type="button" onclick="window.location.href='/profile'">ย้อนกลับ</button>
        <button type="submit">บันทึก</button> <br>
        <a href="" class="forgot">ลืมรหัสผ่าน?</a> <br>
    </form>
@endsection
