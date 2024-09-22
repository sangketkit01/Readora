@extends('user.layout')
@section('title', 'Create password')

@section('content')
    <h5>สร้างรหัสผ่าน</h5>
    <form action="{{ route('create.password') }}" method="POST" id="add-password-form">
        @csrf
        <label for="new_password">รหัสผ่าน
            <input type="password" min="8" name="password" id="n-password" required>
            <p class="mt-2 mb-0 text-secondary" id="password-w" style="font-size: 12px; margin-left:2px"></p>
        </label> <br>
        <label for="new_password_confirmation">ยืนยันรหัสผ่าน
            <input type="password" name="password_confirmation" id="c-password" required>
            <p class="mt-2 mb-0 text-secondary" id="confirm-w" style="font-size: 12px; margin-left:2px"></p>
        </label> <br>
        <button type="button" onclick="window.location.href='/profile'">ย้อนกลับ</button>
        <button type="submit" id="add-password">บันทึก</button>
    </form>

@endsection

@push('scripts')
    <script src="{{ asset('js/user/profile.js') }}"></script>
@endpush
