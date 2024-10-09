@extends('user.layout')
@section('title', 'Home')
@push('style')
    <link rel="stylesheet" href="/css/user/index.css">
    <link rel="stylesheet" href="/css/user/search-result.css">
@endpush

@section('content')
    <div id="mainContainer" class="container">

        <div class="tabs">
            <div class="tab active" id="all">ทั้งหมด</div>
            <div class="tab" id="novel">นิยาย</div>
            <div class="tab" id="comic">คอมมิค</div>
        </div>

        @if ($books->isEmpty())
            <p class="warning">ไม่พบหนังสือในหมวดหมู่ตามที่ค้นหา</p>
        @else
            {{-- <p class="title">นี่คือหมวดหมู่{{ $book->genre->bookGenre_name }}</p> --}}
            <div class="title-genre">
                <p>หมวดหมู่
                    {{ optional($books->first()->genre)->bookGenre_name ?? 'ไม่มีข้อมูลหมวดหมู่' }}
                </p>
            </div>
            <ul id="bookList" class="list-group">
                @foreach ($books as $item)
                    @if ($item->book_status == 'public')
                        {{-- {{ dd($book) }} --}}
                        <li class="list-group-item">
                            @if ($item->Type->bookType_name == 'Novel')
                                <a href="{{ route('novel.incrementAndRedirect', ['bookID' => $item->bookID]) }}">
                                @else
                                    <a href="{{ route('novel.incrementAndRedirectcomic', ['bookID' => $item->bookID]) }}">
                            @endif
                            <div class="book-info">
                                <img src="{{ asset($item->book_pic) }}" alt="{{ $item->book_name }}" class="book-thumbnail">
                                <div>
                                    <h2>{{ $item->book_name }}</h2>
                                    <p><strong>ผู้เขียน:</strong> {{ $item->user->name ?? 'ไม่มีข้อมูล' }}</p>
                                    <p><strong>ประเภท:</strong> {{ $item->Type->bookType_name ?? 'ไม่มีข้อมูล' }}</p>
                                    <p><strong>แนว:</strong> {{ $item->Genre->bookGenre_name ?? 'ไม่มีข้อมูล' }}</p>
                                    <p><strong>เรื่องย่อ:</strong>{{ $item->book_description }}</p>
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
