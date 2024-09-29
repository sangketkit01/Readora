@extends('admin.home')

@section('title', 'Admin Dashboard')
@push('style')
    <link rel="stylesheet" href="/css/admin/searchUser.css">
@endpush

@section('content')
    <form action="/searchUser" method="GET" class="search-form">
        <input type="text" name="query" placeholder="ค้นหา..." class="search-input">
        <button type="submit" class="search-button"><img src="/nav/search.svg" width="20" height="20"
                alt=""></button>
    </form>
    @foreach ($user as $item)
        <p>{{$item->name}}</p>
    @endforeach
@endsection
