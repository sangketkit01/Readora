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
            <div class="cover-upload">
                <label for="inputImage" id="input-image-label" style="background-image:url({{ asset($user->profile) }})"></label>
                <i class="bi bi-camera-fill icon_cam" id="camera-icon" style="cursor: pointer;"></i>
                <input type="file" name="inputImage" id="inputImage" accept="image/*" style="display:none;">
            </div>            
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
        <div class="edit-info mt-4">
            <div class="edit-header">
                <button id="back-icon" onclick="window.location.href='/profile'"> <i
                        class="bi bi-arrow-left-circle-fill "></i> </button>
                <div class="h5">
                    <h5>แก้ไขข้อมูล</h5>
                </div>
            </div>
            <hr>
            <form action="{{ route('edit.info') }}" method="post" class="form_edit">
                @csrf
                <div class="nameuser">
                    <label for="">ชื่อที่ใช้แสดง</label>
                    <span class="span">{{ $user->username }}</span>
                </div>
                <div class="showname">
                    <label for="">ชื่อที่ใช้แสดง</label>
                    <input type="text" name="name" value="{{ $user->name }}" required>
                </div>
                <div class="email">
                    <label for="email">อีเมล</label>
                    <input type="email" name="email" value="{{ $user->email }}" required>
                </div>


                <div class="gender">
                    <label for="gender">เพศ</label> <br>
                    <select name="gender">
                        <option value="F" @if ($user->gender == 'F') selected @endif>หญิง</option>
                        <option value="M" @if ($user->gender == 'M') selected @endif>ชาย</option>
                        <option value="N" @if ($user->gender == 'N') selected @endif>ไม่ระบุ</option>
                    </select>
                </div>
                <div class="password">
                    <label for="password">รหัสผ่าน</label>
                    @if (!empty($user->password))
                        <a href="/changePassword" id="link-change-password">เปลี่ยนรหัสผ่าน</a>
                    @else
                        <button type="button" id="add-password-btn"
                            onclick="window.location.href='/createPassword'">สร้างรหัสผ่าน</button>
                    @endif
                </div>
                <div class="sub">
                    <button id="submit-new-info" type="submit">บันทึก</button>
                </div>
            </form>
        </div>
    @else
        <div class="mt-3 else_user">
            <div class="dropdown-option">
                <a class="btn btn-black dropdown-toggle fs-4 fw-semibold" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    ข้อมูลส่วนตัว
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('book.shelve.novel') }}">ชั้นหนังสือของฉัน</a></li>
                    <li><a class="dropdown-item" href="{{ route('profile.novel') }}">นิยายของฉัน</a></li>
                    <li><a class="dropdown-item" href="{{ route('profile.comic') }}">คอมมิคของฉัน</a></li>
                </ul>
            </div>
            <div class="">
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
