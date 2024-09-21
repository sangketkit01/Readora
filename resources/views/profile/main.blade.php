@extends('user.layout')
@section('title', 'Profile')
@push('style')
    <link rel="stylesheet" href="/css/user/profile.css">
@endpush
@section('containerClassName', 'ProfileContainer')

@section('content')
    <img src="{{ $user->profile }}" alt="" onclick=""> <img src="" alt="">
    <p>{{$user->name}}</p>

    <table>
        <thead>
            <th>นิยาย</th>
            <th>คอมมิค</th>
            <th>ความคิดเห็น</th>
        </thead>
        <tbody>
            <tr>
                <td>{{$n_count == 0 ? '-' : $n_count}}</td>
                <td>{{$c_count == 0 ? '-' : $c_count}}</td>
                <td>-</td>
            </tr>
        </tbody>
    </table>
    
    <p>
        <select name="user-menu" id="user-menu" onchange="handleMenuChange()">
            <option value="/profile">ข้อมูลส่วนตัว</option>
            <option value="novel">นิยาย</option>
            <option value="/change_password_page">คอมมิค</option>
        </select>
    </p>

    @if(isset($username))
        <p><h5>แก้ไขข้อมูล</h5></p>
        ชื่อผู้ใช้งาน: {{$user->username}} <br>
        <form action="{{route('edit.info')}}" method="post">
            @csrf
            ชื่อที่ใช้แสดง <input type="text" name="name" value="{{$user->name}}" required> <br>
            <label for="email">
                อีเมล <input type="email" name="email" value="{{$user->email}}" required>
            </label> <br>
            <label for="password">
                @if(!empty($user->password))
                    รหัสผ่าน <a href="/changePassword" id="link-change-password">เปลี่ยนรหัสผ่าน</a>
                @else
                    รหัสผ่าน <button type="button" id="add-password-btn" onclick="window.location.href='/createPassword'">สร้างรหัสผ่าน</button>
                @endif
            </label> <br>
            <label for="gender">
                เพศ
                <select name="gender">
                    <option value="F" @if($user->gender == 'F') selected @endif>หญิง</option>
                    <option value="M" @if($user->gender == 'M') selected @endif>ชาย</option>
                    <option value="N" @if($user->gender == 'N') selected @endif>ไม่ระบุ</option>
                </select>
            </label> <br>
            <button id="cancle-edit-info" type="button" onclick="window.location.href='/profile'">ยกเลิก</button>
            <button id="submit-new-info" type="submit">บันทึก</button>
        </form>
    @else
        <p>ชื่อที่ใช้แสดง {{$user->name}}</p>
        <p>ชื่อผู้ใช้งาน {{$user->username}}</p>
        <p>อีเมล {{$user->email}}</p>
        <p>Facebook</p>
        @if(!empty($user->password))
            <p>รหัสผ่าน ******* <button id="change-password-btn" onclick="window.location.href='/changePassword'">เปลี่ยนรหัสผ่าน</button></p>
        @else
            <p>รหัสผ่าน <button type="button" id="add-password-btn" onclick="window.location.href='/createPassword'">สร้างรหัสผ่าน</button></p>
        @endif
        <p>เพศ
            @if ($user->gender == 'F')
                หญิง
            @elseif($user->gender == 'M')
                ชาย
            @else
                ไม่ระบุ
            @endif
        </p>
        <button id="edit-info" onclick="window.location.href='/edit_info/{{$user->username}}'">แก้ไขข้อมูล</button> <br>
        <button id="logout" onclick="window.location.href='/singout'">ออกจากระบบ</button>
    @endif

@endsection

@push('scripts')
    <script src="{{ asset('js/user/profile.js') }}"></script>
@endpush