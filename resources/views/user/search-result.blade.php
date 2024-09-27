@extends('user.layout')
@section('title', 'Home')
@push('style')
    <link rel="stylesheet" href="/css/user/index.css">
    <link rel="stylesheet" href="/css/user/search-result.css">
@endpush

@section('content')
<div class="container">
    <div class="tabs">
        <div class="tab active">ทั้งหมด</div>  
        <div class="tab">ชื่อผู้แต่ง</div>
        <div class="tab">นิยาย</div>
        <div class="tab">คอมมิค</div>
    </div>
    <h1 class="result">ผลการค้นหาสำหรับ: "{{ $query }}"</h1>

    @if ($books->isEmpty())
        <p>ไม่พบหนังสือตามที่ค้นหา</p>
    @else
        <ul id="bookList" class="list-group">
            @foreach ($books as $book)
                {{-- {{ dd($book) }} --}}
                {{-- <a href="{{ route('novel.incrementAndRedirect', ['bookID' => $book->bookID]) }}"> --}}
                
                    <li class="list-group-item">
                        <div class="book-info" >
                            <img src="{{ asset($book->book_pic) }}" alt="{{ $book->book_name }}" class="book-thumbnail">
                            
                            <div>
                                <h2>{{ $book->book_name }}</h2>
                                <p><strong>ผู้เขียน:</strong> {{ $book->user->name ?? 'ไม่มีข้อมูล' }}</p>
                                <p><strong>ประเภท:</strong> {{ $book->Type->bookType_name ?? 'ไม่มีข้อมูล' }}</p>
                                <p><strong>แนว:</strong> {{ $book->Genre->bookGenre_name ?? 'ไม่มีข้อมูล' }}</p>
                                <p><strong>เรื่องย่อ:</strong>{{ $book->book_description }}</p>
                            </div>
                        </div>
                    </li>
                </a>
            @endforeach
        </ul>
        <div id="pagination"></div>
    @endif
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/user/new_page.js') }}"></script>
@endpush