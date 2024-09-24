@extends('user.layout')
@section('title', 'Home')
@push('style')
    <link rel="stylesheet" href="/css/user/index.css">
    <link rel="stylesheet" href="/css/user/search-result.css">
@endpush

@section('content')
    <div class="container">
        <h1>ผลการค้นหาสำหรับ: "{{ $query }}"</h1>

        @if ($books->isEmpty())
            <p>ไม่พบหนังสือตามที่ค้นหา</p>
        @else
            <ul class="list-group">
                @foreach ($books as $book)
                    {{-- {{ dd($book) }} --}}
                    <li class="list-group-item">
                        <div class="book-info">
                            <h2>{{ $book->book_name }}</h2>
                            <img src="{{ asset($book->book_pic) }}" alt="{{ $book->book_name }}" class="book-thumbnail">
                            <p><strong>ผู้เขียน:</strong> {{ $book->user->name ?? 'ไม่มีข้อมูล' }}</p>
                            <p><strong>ประเภท:</strong> {{ $book->Type->bookType_name ?? 'ไม่มีข้อมูล' }}</p>
                            <p><strong>แนว:</strong> {{ $book->Genre->bookGenre_name ?? 'ไม่มีข้อมูล' }}</p>
                            <p>{{ $book->book_description }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
