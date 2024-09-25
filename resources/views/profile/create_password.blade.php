@extends('user.layout')
@section('title', 'Create password')
@push('style')
    <link rel="stylesheet" href="/css/profile/password.css">
@endpush
@section('containerClassName', 'CreatePassContainer')


@section('content')
    <div class="password">
        <h5>เปลี่ยนรหัสผ่าน</h5>
        <form action="{{ route('create.password') }}" method="post" id="update-password-form" class="form_password">
            @csrf
            <div class="current_password">
                <label for="new_password">รหัสผ่านใหม่</label>
                <input type="password" min="8" id="n-password" name="n-password" required>
                <div class="password_c">
                    <p class="text-secondary" id="password-w" style="font-size: 12px; margin-left:2px"></p>
                </div>
            </div>

            <div class="current_password">
                <label for="confirm_password">ยืนยันรหัสผ่าน</label>
                <input type="password" id="c-password" required>
                <div class="password_c">
                    <p class="text-secondary" id="confirm-w" style="font-size: 12px; margin-left:2px"></p>
                </div>
            </div>

            <div class="sub">
                <button type="button" id="back" onclick="window.location.href='/profile'">ย้อนกลับ</button>
                <button type="submit" id="create-new-password">บันทึก</button>
            </div>
        </form>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/user/profile.js') }}"></script>
@endpush
