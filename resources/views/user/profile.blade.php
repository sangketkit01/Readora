@extends('user.layout')

@section('title', 'Profile')

@push('style')
    <link rel="stylesheet" href="/css/user/profile.css">
@endpush

@section('containerClassName', 'UserContainer')

@section('content')

    <div class="containner">
        <div class="row pt-5">
            <div id="profile-pic">
                @foreach ($info as $item)
                    <img src="{{ $item->profile }}" alt="" onclick="">
                @endforeach
            </div>

            <div id="about">
                <table border="1">
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

            <div class="user-options">
                <select name="user-menu" id="user-menu">
                    <option value="profile-info">ข้อมูลส่วนตัว</option>
                    <option value="novel">นิยาย</option>
                    <option value="comic">คอมมิค</option>
                </select>
            </div> <br>
        </div>

        <div class="row pt-5">
            <div id="content-area">
                <div id="profile-info" class="content-section">
                    @foreach ($info as $item)
                        <div class="user-info">
                            <p>ชื่อที่ใช้แสดง {{ $item->name }}</p>
                            <p>ชื่อผู้ใช้งาน {{ $item->username }}</p>
                            <p>อีเมล {{ $item->email }}</p>
                            <p>Facebook</p>
                            <p>รหัสผ่าน ******* <button id="change-password-btn">เปลี่ยนรหัสผ่าน</button></p>
                            <p>เพศ
                                @if ($item->gender == 'F')
                                    หญิง
                                @elseif($item->gender == 'M')
                                    ชาย
                                @else
                                    ไม่ระบุ
                                @endif
                            </p>
                        </div>
                    @endforeach
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

    </div>

    <div class="edit-user-info" style="display: none;" id="edit-user-info">
        <p>
        <h5>แก้ไขข้อมูล</h5>
        </p>
        @foreach ($info as $item)
            ชื่อผู้ใช้งาน: {{ $item->username }} <br>
            <form action="{{ route('update_info') }}" method="post">
                @csrf
                ชื่อที่ใช้แสดง <input type="text" id="name" name="name" value="{{ $item->name }}" required>
                <br>
                อีเมล <input type="email" id="email" name="email" value="{{ $item->email }}" required> <br>
                รหัสผ่าน <a href="" id="link-change-password">เปลี่ยนรหัสผ่าน</a> <br>
                เพศ
                <select id="gender" name="gender">
                    <option value="F" @if($item->gender == 'F') selected @endif>หญิง</option>
                    <option value="M" @if($item->gender == 'M') selected @endif>ชาย</option>
                </select> <br>
                <button id="cancle-edit-info" type="button" onclick="window.location.href='/profile'">ยกเลิก</button>
                <button id="submit-new-info" type="submit">บันทึก</button>
            </form>
        @endforeach
    </div>

    <div class="popup" id="popup">
        <div class="close-btn">&times;</div>
        <h5>เปลี่ยนรหัสผ่าน</h5>
        <div class="form-element">
            <form action="{{ route('update_password') }}" method="post">
                <label for="password">รหัสผ่านเดิม
                    <input type="password" name="" id="password" required>
                </label> <br>
                <label for="new_password">รหัสผ่านใหม่
                    <input type="password" name="" id="new_password" required>
                </label> <br>
                <label for="confirm_password">ยืนยันรหัสผ่าน
                    <input type="password" name="" id="confirm_password" required>
                </label> <br>
                <button type="submit">บันทึก</button> <br>
                <a href="{{ url('/forgot')}}" class="forgot">ลืมรหัสผ่าน?</a> <br>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
        <script src="{{ asset('js/user/profile.js') }}"></script>
    @endpush