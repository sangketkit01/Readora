@extends('user.layout')
@section('title', 'Search')
@push('style')
    <link rel="stylesheet" href="/css/user/index.css">
    <link rel="stylesheet" href="/css/user/search-result.css">
@endpush

@section('content')
    <div id="mainContainer" class="container" data-query="{{ $query }}">
        <div class="tabs">
            <div class="tab active" id="all">ทั้งหมด</div>
            <div class="tab" id="author">ชื่อผู้แต่ง</div>
            <div class="tab" id="novel">นิยาย</div>
            <div class="tab" id="comic">คอมมิค</div>
        </div>
        <p class="result">ผลการค้นหาสำหรับ: "{{ $query }}"</p>

        @if ($books->isEmpty())
            <p class="undefind-data">ไม่พบหนังสือตามที่ค้นหา</p>
        @else
            <ul id="bookList" class="list-group">
                @foreach ($books as $book)
                    @if ($book->book_status == 'public')
                        {{-- {{ dd($book) }} --}}

                        <li class="list-group-item">
                            @if ($book->Type->bookType_name == 'Novel')
                                <a href="{{ route('novel.incrementAndRedirect', ['bookID' => $book->bookID]) }}">
                                @else
                                    <a href="{{ route('novel.incrementAndRedirectcomic', ['bookID' => $book->bookID]) }}">
                            @endif
                            <div class="book-info">
                                <img src="{{ asset($book->book_pic) }}" alt="{{ $book->book_name }}" class="book-thumbnail">

                                <div>
                                    <h2>{{ $book->book_name }}</h2>
                                    <p><strong>ผู้เขียน:</strong> {{ $book->user->name ?? 'ไม่มีข้อมูล' }}</p>
                                    <p><strong>ประเภท:</strong> {{ $book->Type->bookType_name ?? 'ไม่มีข้อมูล' }}</p>
                                    <p><strong>แนว:</strong> {{ $book->Genre->bookGenre_name ?? 'ไม่มีข้อมูล' }}</p>
                                    <p><strong>เรื่องย่อ:</strong>{{ $book->book_description }}</p>
                                </div>
                            </div>
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
            <div id="pagination"></div>
        @endif
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/user/new_page.js') }}"></script>
@endpush
