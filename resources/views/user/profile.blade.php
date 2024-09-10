@extends('user.layout')

@section('title','Profile')

@push('style')
    <link rel="stylesheet" href="/css/user/profile.css">
@endpush

@section('containerClassName', 'UserContainer')

@section('content')
    <div id="profile-pic">
        @foreach ($info as $item)
            <img src="{{ $item->profile }}" alt="" onclick="">
        @endforeach
    </div>

    <div id="about">
        นิยาย
        คอมมิค
        ความคิดเห็น
    </div>

    <div class="user-options">
        <select name="user-menu" id="user-menu">
            <option value="profile">ข้อมูลส่วนตัว</option>
            <option value="novel">นิยาย</option>
            <option value="comic">คอมมิค</option>
        </select>
    </div> <br>

    <div id="content-area">
        <div id="profile" class="content-section">
            @foreach ($info as $item)
                <div class="user-info">
                    <p>ชื่อที่ใช้แสดง {{ $item->name }}</p>
                    <p>ชื่อผู้ใช้งาน {{ $item->username }}</p>
                    <p>อีเมล {{ $item->email }}</p>
                    <p>Facebook</p>
                    <p>รหัสผ่าน ******* <button id="change-password">เปลี่ยนรหัสผ่าน</button></p>
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
            <button id="edit-info-button">แก้ไขข้อมูล</button> <br>
            <button id="logout" onclick="window.location.href='/signin'">ออกจากระบบ</button>
        </div>

        <div id="novel" class="content-section" style="display: none;">
            นิยาย นิยาย นิยาย นิยาย
        </div>

        <div id="comic" class="content-section" style="display: none;">
            คอมมิค คอมมิค คอมมิค คอมมิค
        </div>
    </div>

    {{-- <div class="change-password">
        <h2 class="fs-5">Popover in a modal</h2>
        <p>This <button class="btn btn-secondary" data-bs-toggle="popover" title="Popover title"
                data-bs-content="Popover body content is set in this attribute.">button</button> triggers a popover on
            click.</p>
        <hr>
        <h2 class="fs-5">Tooltips in a modal</h2>
        <p><a href="#" data-bs-toggle="tooltip" title="Tooltip">This link</a> and <a href="#"
                data-bs-toggle="tooltip" title="Tooltip">that link</a> have tooltips on hover.</p>
    </div> --}}

    <div class="edit-user-info" style="display: none;" id="">
        <p><h5>แก้ไขข้อมูล</h5></p>
        @foreach ($info as $item)
            ชื่อผู้ใช้งาน: {{ $item->username }} <br>
            <form action="{{ route('update.profile') }}" method="post">
                @csrf
                ชื่อที่ใช้แสดง <input type="text" id="name" name="name" value="{{ $item->name }}" required>
                <br>
                อีเมล <input type="text" id="email" name="email" value="{{ $item->email }}" required> <br>
                เพศ
                <select id="gender" name="gender">
                    <option value="F" @if ($item->gender == 'F') selected @endif>หญิง</option>
                    <option value="M" @if ($item->gender == 'M') selected @endif>ชาย</option>
                </select> <br>
                <button type="button" id="cancle-edit-info-button" onclick="window.location.href='/profile'">ยกเลิก</button>
                <button id="submit-new-info">บันทึก</button>
            </form>
        @endforeach
    </div>

    <script>
        document.getElementById('user-menu').addEventListener('change', function() {
            document.querySelectorAll('.content-section', ).forEach(function(section) {
                section.style.display = 'none';
            });
            let selectedValue = this.value;
            document.getElementById(selectedValue).style.display = 'block';
            document.querySelector('.edit-user-info').style.display = 'none';
        });
        document.getElementById('profile').style.display = 'block';


        document.getElementById('edit-info-button').addEventListener('click', function() {
            document.getElementById('profile').style.display = 'none';
            document.querySelector('.edit-user-info').style.display = 'block';
        });
        document.getElementById('cancle-edit-info-button').addEventListener('click', function() {
            document.querySelector('.edit-user-info').classList.add('hidden');
            document.getElementById('profile').classList.remove('hidden');

        });

        document.getElementById('change-password').addEventListener('click', function() {
            alert("dd")
        });


    </script>
@endsection
