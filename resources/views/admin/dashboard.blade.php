@extends('admin.home')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <div class="box">
        <h2>Novels</h2>
        <h2>{{ $novelCount }}</h2>
    </div>
    <div class="box">
        <h2>Comics</h2>
        <h2>{{ $comicCount }}</h2>
    </div>
    <div class="box">
        <h2>Users</h2>
        <h2>{{ $userCount }}</h2>
    </div>
    <div class="action-box">
        <a href="{{ route('admin.search_admin') }}">
            <img src="admin/Literature.png" alt="Novels">
            <p>Novels</p>
        </a>
    </div>
    <div class="action-box center">
        <a href="{{ route('admin.search_admincomic') }}">
            <img src="admin/comicBook.png" alt="Comics">
            <p>Comics</p>
        </a>
    </div>
    <div class="action-box">
        <a href="{{ route('admin.search_user') }}">
            <img src="admin/User.png" alt="Users">
            <p>Users</p>
        </a>
    </div>
    <div class="action-box">
        <img src="admin/Group108.png" alt="Blocked Novels">
        <p>Blocked Novels</p>
    </div>
    <div class="action-box center">
        <img src="admin/Group109.png" alt="Blocked Comics">
        <p>Blocked Comics</p>
    </div>
    <div class="action-box">
        <img src="admin/Group111.png" alt="Blocked Users">
        <p>Blocked Users</p>
    </div>
</div>
@endsection
