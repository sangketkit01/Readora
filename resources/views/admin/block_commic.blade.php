@extends('admin.home')

@section('title', 'Blocked Books')

@push('style')
    <link rel="stylesheet" href="/css/admin/searchUser.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endpush

@section('content')

    <form action="{{ route('admin.get_info_search') }}" method="GET" class="search-form">
        <input type="text" name="query" placeholder="ค้นหา..." class="search-input" value="{{ request('query') }}">
        <button type="submit" class="search-button">
            <img src="/nav/search.svg" width="20" height="20" alt="search icon">
        </button>
    </form>

    <br>
    <h2 class="box-result">คอมมิกที่ถูกบล็อกทั้งหมด</h2>

    @if ($books && $books->count() > 0)
        <div class="results-container">
            @foreach ($books as $book)
                <div class="result-card">
                    <img src="{{ asset($book->book_pic) ?? '/default-book-cover.png' }}" alt="{{ $book->book_name }}">
                    <div class="result-info">
                        <p>ชื่อเรื่อง: {{ $book->book_name }}</p>
                        <p>ผู้เขียน: {{ $book->User->name ?? 'ไม่พบผู้เขียน' }}</p>
                        <p>ประเภท: {{ $book->Type->bookType_name ?? 'ไม่มีข้อมูล' }}</p>
                        <p>สถานะ: {{ $book->book_status }}</p>
                        <div class="action-buttons">
                            <form action="{{ route('book.unblock', $book->bookID) }}" method="POST"
                                class="d-inline" onsubmit="return confirm('ต้องการปลดบล็อกนิยายนี้ใช่หรือไม่?');">
                                @csrf
                                <button type="submit" class="btn btn-success" title="Unblock Book">
                                    <i class="fas fa-unlock"></i> ปลดบล็อก
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>ไม่พบนิยายที่ถูกบล็อก</p>
    @endif

@endsection
