@extends('user.layout')
@section('content')
    <h5>เปลี่ยนรหัสผ่าน</h5>
    <form action="{{route('change.password')}}" method="post" id="update-password-form" onsubmit="return validateForm()">
        @csrf
        <label for="current_password">รหัสผ่านเดิม
            <input type="password" name="current_password" id="password" required>
        </label> <br>
        <label for="new_password">รหัสผ่านใหม่
            <input type="password" name="new_password" id="n-password" required>
            <p class="mt-2 mb-0 text-secondary" id="password-w" style="font-size: 12px; margin-left:2px">รหัสผ่านต้องมีขั้นต่ำ 8 ตัวอักษร</p>
        </label> <br>
        <label for="confirm_password">ยืนยันรหัสผ่าน
            <input type="password" name="confirm_password" id="c-password" required>
            <p class="mt-2 mb-0 text-secondary" id="confirm-w" style="font-size: 12px; margin-left:2px"></p>
        </label> <br>
        <button type="button" onclick="window.location.href='/profile'">ย้อนกลับ</button>
        <button type="submit">บันทึก</button> <br>
        <a href="/forgot_password" class="forgot">ลืมรหัสผ่าน?</a> <br>
    </form>

    <script>
        function validateForm() {
            const password = document.getElementById("password").value;
            const newPassword = document.getElementById("n-password").value;
            const confirmPassword = document.getElementById("c-password").value;
            const passwordP = document.getElementById("password-w");
            const confirmPasswordP = document.getElementById("confirm-w");

            if (password.length < 8) {
                passwordP.classList.add("text-danger");
                passwordP.classList.remove("text-success");
                return false;
            } else {
                passwordP.classList.remove("text-danger");
                passwordP.classList.add("text-success");
            }
            if (confirmPassword !== password) {
                confirmPasswordP.textContent = "รหัสผ่านไม่ตรงกัน";
                confirmPasswordP.classList.add("text-danger");
                return false;
            } else {
                confirmPasswordP.textContent = "รหัสผ่านตรงกัน";
                confirmPasswordP.classList.remove("text-danger");
                confirmPasswordP.classList.add("text-success");
            }
            return true;
        }
    </script>
@endsection
