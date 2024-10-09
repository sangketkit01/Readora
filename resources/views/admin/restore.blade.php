@extends('admin.home')
@section('title', 'รายการผู้ใช้ที่ถูกลบ')
@push('style')
    <link rel="stylesheet" href="/css/admin/searchUser.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endpush
@section('content')
    <div class="deleted-users-container">
        <button onclick="window.history.back();" class="back-button">
            <i class="fas fa-arrow-left"></i> <!-- ตัวอย่างไอคอนจาก Font Awesome -->
        </button>

        <form action="{{ route('admin.deleted_users') }}" method="GET" class="search-form">
            <input type="text" name="query" placeholder="ค้นหา..." class="search-input" value="{{ request('query') }}">
            <button type="submit" class="search-button"><img src="/nav/search.svg" width="20" height="20"
                    alt=""></button>
        </form>

        <h2 class="box-result" style="margin-top: 20px">รายการผู้ใช้ที่ถูกลบ</h2>



        @if ($deletedUsers->count() > 0)
            <div class="results-container">
                @foreach ($deletedUsers as $user)
                    {{-- {{ dd($user) }} --}}
                    <div class="result-card">
                        <img src="{{ $user->profile ?? '/default-avatar.png' }}" alt="User avatar">
                        <div class="result-info">
                            <p><strong>ชื่อ:</strong> {{ $user->name }}</p>
                            <p><strong>อีเมล:</strong> {{ $user->username }}</p>
                            <p><strong>เพศ:</strong> {{ $user->gender }}</p>

                            <div class="action-buttons">
                                <form class action="{{ route('admin.restore_user') }}" method="POST" onsubmit="return confirm('Are you sure you want to resotre this user?');">
                                    @csrf
                                    <input type="hidden" name="username" value="{{ $user->username }}">
                                    <button type="submit" class="restore-button" title="กู้คืนผู้ใช้" >
                                        <i class="fas fa-user-plus"></i> กู้คืน
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="no-results" style="padding: 10px">ไม่พบผู้ใช้ที่ถูกลบ</p>
        @endif
    </div>
@endsection
