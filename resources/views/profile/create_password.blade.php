@extends('user.layout')
@section('content')
    <h5>สร้างรหัสผ่าน</h5>
    <form action="{{ route('create.password') }}" method="POST" id="add-password-form">
        @csrf
        <label for="new_password">รหัสผ่าน
            <input type="password" name="new_password" id="new_password" required>
        </label> <br>
        <label for="new_password_confirmation">ยืนยันรหัสผ่าน
            <input type="password" name="new_password_confirmation" id="new_password_confirmation" required>
        </label> <br>
        <button type="button" onclick="window.location.href='/profile'">ย้อนกลับ</button> 
        <button type="submit" id="add-password">บันทึก</button>
    </form>
@endsection
