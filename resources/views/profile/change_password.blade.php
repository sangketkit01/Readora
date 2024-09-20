@extends('user.layout')
@section('content')
    <h5>เปลี่ยนรหัสผ่าน</h5>
    <form action="{{route('change.password')}}" method="post" id="update-password-form" onsubmit="return validateForm()">
        @csrf
        <label for="current_password">รหัสผ่านเดิม
            <input type="password" name="current_password" id="password" required>
        </label> <br>
        <label for="new_password">รหัสผ่านใหม่
            <input type="password" min="8" name="password" id="n-password" required> 
            <p class="mt-2 mb-0 text-secondary" id="password-w" style="font-size: 12px; margin-left:2px">รหัสผ่านต้องมีขั้นต่ำ 8 ตัวอักษร</p>
        </label> <br>
        <label for="confirm_password">ยืนยันรหัสผ่าน
            <input type="password" name="password_confirmation" id="c-password" required>
            <p class="mt-2 mb-0 text-secondary" id="confirm-w" style="font-size: 12px; margin-left:2px"></p>
        </label> <br>
        <button type="button" onclick="window.location.href='/profile'">ย้อนกลับ</button>
        <button type="submit">บันทึก</button> <br>
        <a href="/forgot_password" class="forgot">ลืมรหัสผ่าน?</a> <br>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('js/user/profile.js') }}"></script>
@endpush
