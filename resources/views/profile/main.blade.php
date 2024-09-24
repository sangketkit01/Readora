@extends('user.layout')
@section('title', 'Profile')
@push('style')
    <link rel="stylesheet" href="/css/profile/profile.css">
@endpush
@section('containerClassName', 'ProfileContainer')

@section('content')
    <div class="row mt-3">
        <div class="top">
            <img src="{{ $user->profile }}" alt="" onclick="">
            <p>{{ $user->name }}</p>
            <table>
                <thead>
                    <th>นิยาย</th>
                    <th>คอมมิค</th>
                    <th>ความคิดเห็น</th>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $n_count == 0 ? '-' : $n_count }}</td>
                        <td>{{ $c_count == 0 ? '-' : $c_count }}</td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    @if (isset($username))
        <div class="row mt-3">
            <div class="edit-info">
                <div class="edit-header">
                    <button id="back-icon" onclick="window.location.href='/profile'"> <i class="bi bi-arrow-left-circle-fill "></i> </button> 
                    <h5>แก้ไขข้อมูล</h5>
                </div>
                ชื่อผู้ใช้งาน: {{ $user->username }} <br>
                <form action="{{ route('edit.info') }}" method="post">
                    @csrf
                    ชื่อที่ใช้แสดง <input type="text" name="name" value="{{ $user->name }}" required> <br>
                    <label for="email">
                        อีเมล <input type="email" name="email" value="{{ $user->email }}" required>
                    </label> <br>
                    <label for="password">
                        @if (!empty($user->password))
                            รหัสผ่าน <a href="/changePassword" id="link-change-password">เปลี่ยนรหัสผ่าน</a>
                        @else
                            รหัสผ่าน <button type="button" id="add-password-btn"
                                onclick="window.location.href='/createPassword'">สร้างรหัสผ่าน</button>
                        @endif
                    </label> <br>
                    <label for="gender">
                        เพศ
                        <select name="gender">
                            <option value="F" @if ($user->gender == 'F') selected @endif>หญิง</option>
                            <option value="M" @if ($user->gender == 'M') selected @endif>ชาย</option>
                            <option value="N" @if ($user->gender == 'N') selected @endif>ไม่ระบุ</option>
                        </select>
                    </label> <br>
                    <button id="submit-new-info" type="submit">บันทึก</button>
                </form>
            </div>
        </div>
    @else
        <div class="row mt-3">
            <div class="col-8">
                <div class="dropdown-option">
                    <a class="btn btn-black dropdown-toggle fs-4 fw-semibold" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        ข้อมูลส่วนตัว
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('profile.novel') }}">นิยาย</a></li>
                        <li><a class="dropdown-item" href="{{ route('profile.comic') }}">คอมมิค</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-4">
                <button id="edit-info" onclick="window.location.href='/profile/{{ $user->username }}'"
                    class="ms-5">แก้ไขข้อมูล</button>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-5">
                <div class="text-end text-about">
                    <p>ชื่อที่ใช้แสดง</p>
                    <p>ชื่อผู้ใช้งาน</p>
                    <p>อีเมล</p>
                    <p>Facebook</p>
                    <p>เพศ</p>
                    <p>รหัสผ่าน</p>
                </div>
            </div>
            <div class="col-7">
                <div class="ms-3">
                    <p>{{ $user->name }}</p>
                    <p>{{ $user->username }}</p>
                    <p>{{ $user->email }}</p>
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
                        @if (!empty($user->password))
                            ************* <button id="change-password-btn"
                                onclick="window.location.href='/changePassword'">เปลี่ยนรหัสผ่าน</button>
                        @else
                            <button type="button" id="add-password-btn"
                                onclick="window.location.href='/createPassword'">สร้างรหัสผ่าน</button>
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center mt-4">
            <hr>
            <button id="logout" onclick="window.location.href='/signout'">ออกจากระบบ</button>
        </div>
    @endif


@endsection

@push('scripts')
    <script src="{{ asset('js/user/profile.js') }}"></script>
@endpush
