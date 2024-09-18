@extends('user.layout')

@section('title', 'Profile')

@push('style')
    <link rel="stylesheet" href="/css/user/profile.css">
@endpush

@section('containerClassName', 'ProfileContainer')

@section('content')
    <div class="container">
        <div class="row pt-3">
            <div class="user">
                <div id="profile-top">
                        <img src="{{ $info->profile }}" alt="" onclick=""> <br>
                        <p>{{ $info->name }}</p>
                </div>
                <div class="row">
                    <div id="about">
                        <table>
                            <thead>
                                <th>นิยาย</th>
                                <th>คอมมิค</th>
                                <th>ความคิดเห็น</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row pt-3">
                <div class="user-options">
                    <select name="user-menu" id="user-menu">
                        <option value="profile-info">ข้อมูลส่วนตัว</option>
                        <option value="novel">นิยาย</option>
                        <option value="comic">คอมมิค</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row pt-4">
            <div id="content-area">
                <div id="profile-info" class="content-section">
                        <div class="user-info">
                            <p>ชื่อที่ใช้แสดง {{ $info->name }}</p>
                            <p>ชื่อผู้ใช้งาน {{ $info->username }}</p>
                            <p>อีเมล {{ $info->email }}</p>
                            <p>Facebook</p>
                            @if(!empty($info->password))
                                <p>รหัสผ่าน ******* <button id="change-password-btn" onclick="window.location.href='/change_password_page'">เปลี่ยนรหัสผ่าน</button></p>
                            @else
                                <p>รหัสผ่าน <button id="add-password-btn" onclick="window.location.href='/create_password_page'">สร้างรหัสผ่าน</button></p>
                            @endif
                            <p>เพศ
                                @if ($info->gender == 'F')
                                    หญิง
                                @elseif($info->gender == 'M')
                                    ชาย
                                @else
                                    ไม่ระบุ
                                @endif
                            </p>
                        </div>
                    <button id="edit-info">แก้ไขข้อมูล</button> <br>
                    <button id="logout" onclick="window.location.href='/signin'">ออกจากระบบ</button>
                </div>

                <div id="novel" class="content-section" style="display: none;">
                    <button onclick="window.location.href=''">สร้างเรื่องใหม่</button>
                </div>

                <div id="comic" class="content-section" style="display: none;">
                    <button onclick="window.location.href=''">สร้างเรื่องใหม่</button>
                </div>
            </div>
        </div>

        {{-- edit info --}}
        <div class="edit-user-info" style="display: none;" id="edit-user-info">
            <p> <h5>แก้ไขข้อมูล</h5> </p>
                ชื่อผู้ใช้งาน: {{ $info->username }} <br>
                <form action="{{ route('update_info') }}" method="post">
                    @csrf
                    ชื่อที่ใช้แสดง <input type="text" name="name" value="{{ $info->name }}" required> <br>
                    <label for="email">
                        อีเมล <input type="email" name="email" value="{{ $info->email }}" required>
                    </label> <br>
                    <label for="password">
                        รหัสผ่าน <a href="/change_password_page" id="link-change-password">เปลี่ยนรหัสผ่าน</a>
                    </label> <br>
                    <label for="gender">
                        เพศ
                        <select name="gender">
                            <option value="F" @if ($info->gender == 'F') selected @endif>หญิง</option>
                            <option value="M" @if ($info->gender == 'M') selected @endif>ชาย</option>
                            <option value="none" @if ($info->gender == 'none') selected @endif>ไม่ระบุ</option>
                        </select>
                    </label> <br>
                    <button id="cancle-edit-info" type="button" onclick="window.location.href='/profile'">ยกเลิก</button>
                    <button id="submit-new-info" type="submit">บันทึก</button>
                </form> 
        </div>
    </div>

    {{-- change password --}}
    {{-- <div class="popup" id="">
        <div class="close-btn">&times;</div>
        <h5>เปลี่ยนรหัสผ่าน</h5>
        <div class="form-element">
            <form action="{{route('update_password')}}" method="post" id="update-password-form">
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
                <button type="submit">บันทึก</button> <br>
                <a href="{{ url('/forgot') }}" class="forgot">ลืมรหัสผ่าน?</a> <br>
            </form>
        </div>
    </div> --}}

    {{-- add password --}}
    {{-- <div class="popup2" id="">
        <div class="close-btn">&times;</div>
        <h5>สร้างรหัสผ่าน</h5>
        <div class="form-element">
            <form action="{{route('add_password')}}" method="post" id="add-password-form">
                @csrf
                <label for="new_password">รหัสผ่าน
                    <input type="password" name="new_password" id="new_password" required>
                </label> <br>
                <label for="new_password_confirmation">ยืนยันรหัสผ่าน
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" required>
                </label> <br>
                <button type="submit" id="add-password">บันทึก</button> <br>
            </form>
        </div>
    </div> --}}

@endsection

@push('scripts')
    <script src="{{ asset('js/user/profile.js') }}"></script>
@endpush
