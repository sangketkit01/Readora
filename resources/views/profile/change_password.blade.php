@extends('user.layout')
@section('title', 'Change password')
@push('style')
    <link rel="stylesheet" href="/css/profile/password.css">
@endpush
@section('containerClassName', 'ChangePassContainer')

@section('content')
    <div class="password">
        <h5>เปลี่ยนรหัสผ่าน</h5>
        <form action="{{route('change.password')}}" method="post" id="update-password-form">
            @csrf
            <label for="current_password">รหัสผ่านเดิม
                <input type="password" name="current_password" id="password" required> <p></p>
                @error('current_password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </label> <br>
            <label for="new_password">รหัสผ่านใหม่
                <input type="password" min="8" id="n-password" name="n-password" required> 
                <p class="text-secondary" id="password-w" style="font-size: 12px; margin-left:2px"></p>
                @error('current_password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </label> <br>
            <label for="confirm_password">ยืนยันรหัสผ่าน
                <input type="password" id="c-password" required>
                <p class="text-secondary" id="confirm-w" style="font-size: 12px; margin-left:2px"></p>
                @error('current_password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </label> <br>
            <button type="button" id="back" onclick="window.location.href='/profile'">ย้อนกลับ</button>
            <button type="submit" id="create-new-password" >บันทึก</button> <br>
            <a href="/forgot_password" class="forgot">ลืมรหัสผ่าน?</a> <br>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/user/profile.js') }}"></script>
@endpush
