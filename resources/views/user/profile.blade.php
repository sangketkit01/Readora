@extends('user.layout')

@section('title', 'Profile')

@push('style')
    <link rel="stylesheet" href="/css/user/profile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
@endpush

@section('containerClassName', 'UserContainer')

@section('content')
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
                    <p>ชื่อที่ใช้แสดง: {{ $item->name }}</p>
                    <p>ชื่อผู้ใช้งาน: {{ $item->username }}</p>
                    <p>อีเมลล์: {{ $item->email }}</p>
                    <p>Facebook:</p>
                    <p>รหัสผ่าน: ******* <button id="change-password">เปลี่ยนรหัสผ่าน</button></p>
                    <p>เพศ:
                        @if ($item->gender == 'F')
                            หญิง
                        @elseif($item->gender == 'M')
                            ชาย
                        @endif
                    </p>
                </div>
            @endforeach
            <div class="user-actions">
                <button id="edit-info-button">แก้ไขข้อมูล</button>
                <button id="logout">ออกจากระบบ</button>
            </div>
        </div>

        <div id="novel" class="content-section" style="display: none;">
            นิยาย นิยาย นิยาย นิยาย
        </div>

        <div id="comic" class="content-section" style="display: none;">
            คอมมิค คอมมิค คอมมิค คอมมิค
        </div>
    </div>

    <div class="change-password">
    </div>

    <div class="edit-user-info" style="display: none;" id="">
        @foreach ($info as $item)
            ชื่อผู้ใช้งาน: {{ $item->username }} <br>
            <form action="" method="get">
                ชื่อที่ใช้แสดง <input type="text" name="" id="" value="{{ $item->name }}" required>
                <br>
                อีเมล <input type="text" name="" id="" value="{{ $item->email }}" required> <br>
                เพศ:
                <select name="gender" id="gender">
                    <option value="F" @if ($item->gender == 'F') selected @endif>หญิง</option>
                    <option value="M" @if ($item->gender == 'M') selected @endif>ชาย</option>
                </select> <br>
                <button id="cancle-edit-info-button">ยกเลิก</button>
                <button type="submit" id="submit-new-info">บันทึก</button>
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
        });
        document.getElementById('profile').style.display = 'block';

        document.getElementById('edit-info-button').addEventListener('click', function() {
            document.getElementById('profile').style.display = 'none';
            document.querySelector('.edit-user-info').style.display = 'block';
        });
        document.getElementById('cancle-edit-info-button').addEventListener('click', function() {
            document.querySelector('.edit-user-info').style.display = 'none';
            document.getElementById('profile').style.display = 'block';
        });
    </script>
@endsection
