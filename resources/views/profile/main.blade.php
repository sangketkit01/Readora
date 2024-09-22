@extends('user.layout')
@section('title', 'Profile')
@push('style')
    <link rel="stylesheet" href="/css/profile/profile.css">
@endpush

@section('content')
    <div class="container">

        <div class="row mt-3">
            <div class="col">
                <div class="top">
                    <img src="{{ $user->profile }}" alt="" onclick=""> 
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
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-8">
                <p>
                    <select name="user-menu" onchange="handleMenuChange()">
                        <option value="/profile">ข้อมูลส่วนตัว</option>
                        <option value="/novelInfo/">นิยาย</option>
                        <option value="/comicInfo/">คอมมิค</option>
                    </select>
                </p>
            </div>
            <div class="col-4">
                <button id="edit-info" onclick="window.location.href='/profile/{{$user->username}}'" class="ms-4">แก้ไขข้อมูล</button>
            </div>
        </div>
    
        @if(isset($username))
        <div class="row mt-3">
            <div class="col">
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
                            รหัสผ่าน <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16"> <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/></svg>
                            <a href="/changePassword" id="link-change-password">เปลี่ยนรหัสผ่าน</a>
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
            </div>
        </div>
        @else
        <div class="row mt-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 text-end text-about">
                                <p>ชื่อที่ใช้แสดง</p>
                                <p>ชื่อผู้ใช้งาน</p>
                                <p>อีเมล</p>
                                <p>Facebook</p>
                                <p>เพศ</p>
                                <p>รหัสผ่าน</p>

                        </div>
                    <div class="col-4 ms-2">
                            <p>{{$user->name}}</p>
                            <p>{{$user->username}}</p>
                            <p>{{$user->email}}</p>
                            <p>(wait)</p>
                            <p>
                                @if ($user->gender == 'F')
                                    หญิง
                                @elseif($user->gender == 'M')
                                    ชาย
                                @else
                                    ไม่ระบุ
                                @endif
                            </p>
                            <p>
                                @if(!empty($user->password))
                                    ******* <button id="change-password-btn" onclick="window.location.href='/changePassword'">เปลี่ยนรหัสผ่าน</button></p>
                                @else
                                    <button type="button" id="add-password-btn" onclick="window.location.href='/createPassword'">สร้างรหัสผ่าน</button></p>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col d-flex justify-content-center mt-4">
                <hr>

                <button id="logout" onclick="window.location.href='/singout'" class="ms-5">ออกจากระบบ</button>
            </div>
        </div>
        @endif
        
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/user/profile.js') }}"></script>
@endpush