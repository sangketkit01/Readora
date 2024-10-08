@extends('admin.home')

@section('title', 'Admin Dashboard')
<link rel="stylesheet" href="{{ asset('css/admin/mainpage.css') }}">
@section('content')
    <div class="container">
        <div class="box">
            <h2>นิยาย</h2>
            <h2>{{ $novelCount }}</h2>
        </div>
        <div class="box">
            <h2>คอมมิก</h2>
            <h2>{{ $comicCount }}</h2>
        </div>
        <div class="box">
            <h2>ผู้ใช้</h2>
            <h2>{{ $userCount }}</h2>
        </div>
        <div class="action-box">
            <a href="{{ route('admin.search_admin') }}">
                <img src="{{asset('admin/Literature.png')}}" alt="Novels">
                <p>นิยาย</p>
            </a>
        </div>
        <div class="action-box center">
            <a href="{{ route('admin.search_admincomic') }}">
                <img src="{{asset('admin/comicBook.png')}}" alt="Comics">
                <p>คอมมิก</p>
            </a>
        </div>
        <div class="action-box">
            <a href="{{ route('admin.search_user') }}">
                <img src="{{asset('admin/User.png')}}" alt="Users">
                <p>ผู้ใช้</p>
            </a>
        </div>
        <div class="action-box">
            <a href="{{ route('admin.blocked_books') }}">
                <img src="{{asset('admin/Group108.png')}}" alt="Blocked Novels">
                <p>นิยาย</p><p>ที่ถูกบล็อก</p>
            </a>
        </div>
        <div class="action-box center">
            <a href="{{ route('admin.blocked_comic') }}">
                <img src="{{asset('admin/Group109.png')}}" alt="Blocked Comics">
                <p>คอมมิก</p><p>ที่ถูกบล็อก</p>
            </a>
        </div>
        <div class="action-box">
            <a href="{{ route('admin.checkreport') }}">
            <img src="{{asset('admin/Group111.png')}}" alt="Blocked Users">
            <p>ตรวจสอบ</p>
            <p>รายงาน</p>
            </a>
        </div>
    </div>
@endsection
