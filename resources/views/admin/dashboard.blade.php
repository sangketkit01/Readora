@extends('admin.home')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="box">
        <h2>Novels</h2>
    </div>
    <div class="box">
        <h2>Comics</h2>
    </div>
    <div class="box">
        <h2>Users</h2>
    </div>
    <div class="action-box">
        <a href="{{ route('admin.search_admin') }}">
        <img src="https://img.icons8.com/material/48/000000/book.png" alt="Novels">
        <p>Novels</p>
        </a>
    </div>
    <div class="action-box center">
        <a href="{{ route('admin.search_admincomic') }}">
        <img src="https://img.icons8.com/material/48/000000/book.png" alt="Comics">
        <p>Comics</p>
        </a>
    </div>
    <div class="action-box">
        <img src="https://img.icons8.com/material/48/000000/user.png" alt="Users">
        <p>Users</p>
    </div>
    <div class="action-box">
        <img src="https://img.icons8.com/material/48/000000/cancel-2.png" alt="Blocked Novels">
        <p>Blocked Novels</p>
    </div>
    <div class="action-box center">
        <img src="https://img.icons8.com/material/48/000000/cancel-2.png" alt="Blocked Comics">
        <p>Blocked Comics</p>
    </div>
    <div class="action-box">
        <img src="https://img.icons8.com/material/48/000000/cancel-2.png" alt="Blocked Users">
        <p>Blocked Users</p>
    </div>
@endsection
