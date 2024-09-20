@extends('user.layout')
@section('title', 'Home')
@push('style')
    <link rel="stylesheet" href="/css/user/read.css">
@endpush
@section('containerClassName', 'indexContainer')

@section('content')
    @foreach ($books as $book)
        <div class="container_user">
            <div class="card_user">
                <div class="img row col-4">
                    <img src="{{ asset($book->book_pic) }}" alt="">

                </div>
                <div class="user col-8">
                    <div class="head">
                        <h1>{{ $book->book_name }}</h1> {{-- loopข้อมูลมาวส่สะ --}}
                    </div>
                    <div class="profile_user">
                        <img src="{{ $book->User->profile }}" alt=""> {{-- loopข้อมูลมาวส่สะ --}}
                        <p>{{ $book->User->name }}</p> {{-- loopข้อมูลมาวส่สะ --}}
                    </div>
                    <div class="type">
                        <h4>{{ $book->BookType->bookType_name }}</h4> {{-- loopข้อมูลมาวส่สะ --}}
                    </div>
                    <div class="button">
                        <a href="" class="button_1">เพิ่มเข้าชั้น</a>
                        <a href="" class="button_2">อ่านเลย</a>
                    </div>
                </div>
            </div>
            <div class="Introducing">
                <h4>แนะนำเนื้อเรื่อง</h4>
                <p>{{ $book->book_description }}</p>
            </div>
            <div class="All_episodes">
                <h4>ตอนทั้งหมด ( {{ $count_chapter }} )</h4>
                <select name="" id="">
                    <option value="0">ตอนทั้งหมด</option>
                    <option value="1">ตอนล่าสุด</option>
                    <option value="2">ตอนแรก</option>
                </select>
                <div class="">
                    <hr>
                    @php
                        $count = 0;
                    @endphp
                    @foreach ($chapters as $chapter)
                        <div class="col-8" id="sub-chap">
                            @php
                                $count += 1;
                            @endphp
                            <strong>{{ $count }}</strong>
                            <strong><a href="#" id="edit-chapter-href">{{ $chapter->chapter_name }}</a></strong>
                        </div>
                    @endforeach
                    <hr>
                </div>
            </div>
            <div class="comment">
                <h4>แสดงความคิดเห็น</h4>
                <textarea placeholder="แสดงความคิดเห็นที่นี้..........."></textarea
                        <input type="text" >
                    </div>
                    <div class="com">
                        <div class="pofile_user_com">
                            <img src="{{ $book->User->profile }}" alt=""> 
                            <p>{{ $book->User->name }}</p> 
                        </div>
                        <textarea readonly>ลูปความเห็นมาใส่นี่</textarea>
            </div>
    @endforeach

@endsection
