@extends('user.layout')
@section('title', 'Home')
@push('style')
    <link rel="stylesheet" href="/css/user/read.css">
@endpush
@section('containerClassName', 'indexContainer')

@section('content')
{{-- @foreach ($books as $book) --}}
<div class="container_user">
    <div class="card_user">
        <div class="img">
            <img src="{{ asset('novel/test.jpg') }}" alt=""> {{-- loopข้อมูลมาวส่สะ --}}
        </div>
        <div class="user">
            <div class="head">
                <h1>ชื่อออออออออออออออออออออออออออออออ</h1> {{-- loopข้อมูลมาวส่สะ --}}
            </div>
            <div class="profile_user">
                <img src="{{ asset('novel/test.jpg') }}" alt=""> {{-- loopข้อมูลมาวส่สะ --}}
                <p>บอลลลลลล</p> {{-- loopข้อมูลมาวส่สะ --}}
            </div>
            <div class="type">
                <h4>ประเภท : นิยาย</h4> {{-- loopข้อมูลมาวส่สะ --}}
                <p>ไม่รูคือไร</p>{{-- loopข้อมูลมาวส่สะ --}}
            </div>
            <div class="button">
                <a href="" class="button_1">เพิ่มเข้าชั้น</a>
                <a href="" class="button_2">อ่านเลย</a>
            </div>
        </div>
    </div>
    <div class="Introducing">
        <h4>แนะนำเนื้อเรื่อง</h4>
        <a href="">เพิ่มคำแนะนำเนื้อเรื่อง</a>
    </div>
    <div class="All_episodes">
        <h4>ตอนทั้งหมด (0)</h4>
        <select name="" id="">
            <option value="">ตอนทั้งหมด</option> {{-- loopข้อมูลมาวส่สะ --}}
            <option value="">ตอนทั้งหมด</option> {{-- loopข้อมูลมาวส่สะ --}}
            <option value="">ตอนทั้งหมด</option> {{-- loopข้อมูลมาวส่สะ --}}
        </select>
    </div>
    <div class="comment">
        <h4>แสดงความคิดเห็น</h4>
        <textarea placeholder="แสดงความคิดเห็นที่นี้..........."></textarea
            <input type="text" >
        </div>
        <div class="com">
            <div class="pofile_user_com">
                <img src="{{ asset('novel/test.jpg') }}" alt=""> {{-- loopข้อมูลมาวส่สะ --}}
                <p>บอลลลลลล</p> {{-- loopข้อมูลมาวส่สะ --}}
            </div>
            <textarea>ลูปความเห็นมาใส่นี่</textarea> {{-- loopข้อมูลมาวส่สะ --}}
    </div>
</div>
{{-- @endforeach --}}

@endsection