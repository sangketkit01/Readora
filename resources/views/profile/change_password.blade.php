@extends('user.layout')
@section('title', 'Change password')
@push('style')
    <link rel="stylesheet" href="/css/profile/password.css">
@endpush
@section('containerClassName', 'ChangePassContainer')

@section('content')

<div class="password">
    @if ($errors->has('current_password'))
        <div class="alert alert-danger " style="border: 1px">
            {{ $errors->first('current_password') }}
        </div>
    @endif
    <h5>เปลี่ยนรหัสผ่าน</h5>
    <hr>
    <form action="{{ route('change.password') }}" method="post" id="update-password-form" class="form_password">
        @csrf

        <div class="c_password">

            <label for="current_password">รหัสผ่านเดิม</label>
            <input type="password" id="password" name="current_password" required>

        </div>
        <div class="c_password">

            <label for="n-password">รหัสผ่านใหม่</label>
            <input type="password" min="8" id="new_password" name="n-password" required>
            <div class="password_c">
                <p class="text-secondary" id="password-w" style="font-size: 12px; margin-left:2px"></p>
            </div>

        </div>
        <div class="c_password">

            <label for="c-password">ยืนยันรหัสผ่าน</label>
            <input type="password" min="8" id="comfirm_password" name="c-password" required>
            <div class="password_c">
                <p class="text-secondary" id="confirm-w" style="font-size: 12px; margin-left:2px"></p>
            </div>

        </div>

        <div class="sub">
            <button type="button" id="back" onclick="window.location.href='/profile'">ย้อนกลับ</button>
            <button type="submit" id="create-new-password">บันทึก</button>
        </div>
        <a href="/forgot_password" class="forgot">ลืมรหัสผ่าน?</a>
    </form>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/user/profile.js') }}"></script>
@endpush
