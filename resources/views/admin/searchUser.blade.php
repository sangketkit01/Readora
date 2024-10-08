@extends('admin.home')

@section('title', 'Admin Dashboard')
@push('style')
    <link rel="stylesheet" href="/css/admin/searchUser.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endpush

@section('content')
    <button onclick="window.history.back();" class="back-button">
        <i class="fas fa-arrow-left"></i> <!-- ตัวอย่างไอคอนจาก Font Awesome -->
    </button>
    @if (isset($user))

        <form action="{{ route('admin.get_info_search') }}" method="GET" class="search-form">
            <input type="text" name="query" placeholder="ค้นหา..." class="search-input" value="{{ $query }}">
            <button type="submit" class="search-button">
                <img src="{{ asset('nav/search.svg') }}" width="20" height="20" alt="ค้นหา">
            </button>
        </form>
        <div class="box-restore">
            <a href="{{ route('admin.deleted_users') }}" class="btn btn-warning">
                <i class="fas fa-user-slash"></i> ดูผู้ใช้ที่ถูกลบ
            </a>
        </div>

        @if ($query && $user && $user->count() > 0)
            <h2 class="box-result">ผลลัพธ์การค้นหา</h2>
            <div class="results-container">
                @foreach ($user as $item)
                    <div class="result-card">
                        <img src="{{ $item->profile ?? '/default-avatar.png' }}" alt="User avatar">
                        <div class="result-info">
                            <p>name :{{ $item->name }}</p>
                            <p>email: {{ $item->username }}</p>
                            <p>gender: {{ $item->gender }}</p>
                            <div class="action-buttons">
                                <form action="{{ route('admin.delete_user') }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    <input type="hidden" name="username" value="{{ $item->username }}">
                                    <button type="submit" class="btn btn-danger" title="Delete User">
                                        <i class="fas fa-trash"></i> ลบ
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif($query)
            <p>ไม่พบผลลัพธ์ที่ตรงกับ "{{ $query }}"</p>
        @else
            <h2 class="box-result">ผู้ใช้ทั้งหมด</h2>
            <div class="results-container">
                @foreach ($user as $item)
                    <div class="result-card">
                        <img src="{{ $item->profile ?? '/default-avatar.png' }}" alt="User avatar">
                        <div class="result-info">
                            <p>name :{{ $item->name }}</p>
                            <p>email: {{ $item->username }}</p>
                            <p>gender: {{ $item->gender }}</p>
                            <div class="action-buttons">
                                <form action="{{ route('admin.delete_user') }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    <input type="hidden" name="username" value="{{ $item->username }}">
                                    <button type="submit" class="btn btn-danger" title="Delete User">
                                        <i class="fas fa-trash"></i> ลบ
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @else
        <form action="{{ route('admin.get_info_search') }}" method="GET" class="search-form">
            <input type="text" name="query" placeholder="ค้นหา..." class="search-input"
                value="{{ request('query') }}">
            <button type="submit" class="search-button"><img src="/nav/search.svg" width="20" height="20"
                    alt=""></button>
        </form>

        <div class="box-restore">
            <a href="{{ route('admin.deleted_users') }}" class="btn btn-warning">
                <i class="fas fa-user-slash"></i> ดูผู้ใช้ที่ถูกลบ
            </a>
        </div>
    @endif
@endsection
