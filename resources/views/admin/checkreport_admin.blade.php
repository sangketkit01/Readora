@extends('admin.home')
@section('title', 'Checkreport')
@push('style')
    <link rel="stylesheet" href="/css/admin/checkreport_admin.css">
@endpush

@section('containerClassName', 'checkreportContainer')

@section('content')
<div id="mainContainer" class="container">
    <div class="tabs">
        <div class="tab active" id="all">ทั้งหมด</div>
        <div class="tab" id="novel">นิยาย</div>
        <div class="tab" id="comic">คอมมิค</div>
    </div>

    @if ($reports->isEmpty())
        <p class="warning">ไม่พบหนังสือในหมวดหมู่ตามที่ค้นหา</p>
    @else
        {{-- <p class="title">นี่คือหมวดหมู่{{ $book->genre->bookGenre_name }}</p> --}}
        <div class="title-genre">
            <p>รายงานทั้งหมด
            </p>
        </div>
        <ul id="bookList" class="list-group">
            @foreach ($reports as $item)
                {{-- {{ dd($book) }} --}}
                    <li class="list-group-item">
                        <div class="book-info">
                            <img src="{{ asset($item->book->book_pic) }}" alt="{{ $item->book->book_name }}" class="book-thumbnail">
                            <div>
                                <h2>{{ $item->book->book_name }}</h2>
                                <p><strong>ผู้เขียน:</strong> {{ $item->book->user->name ?? 'ไม่มีข้อมูล' }}</p>
                                <p><strong>ประเภท:</strong> {{ $item->book->Type->bookType_name ?? 'ไม่มีข้อมูล' }}</p>
                                <p><strong>แนว:</strong> {{ $item->book->Genre->bookGenre_name ?? 'ไม่มีข้อมูล' }}</p>
                                <p><strong>เรื่องย่อ:</strong>{{ $item->book->book_description }}</p>
                            </div>
                        </div>
                    </li>
            @endforeach
        </ul>
        <div id="pagination"></div>
    @endif
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/user/new_page.js') }}"></script>
@endpush