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
                        <div class="img row col-4 md-6 sm-12">
                            <img src="{{ asset($book->book_pic) }}
                        " alt="">

                        </div>
                        <div class="user col-8 md-6 sm-12">
                            <div class="head">
                                <h1>{{ $book->book_name }}
                                </h1>
                            </div>
                            <div class="profile_user">
                                <img src="{{ asset($book->User->profile) }}
                        " alt="" style="object-fit: cover">
                                <p>{{ $book->User->name }}
                                </p>
                            </div>
                            <div class="type">
                                <h4>{{ $book->Genre->bookGenre_name }}</h4>
                            </div>
                            <div class="button">
                                <form action="{{ route('add_to_shelf') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="bookID" value="{{ $book->bookID }}">
                                    <button type="submit" class="button_1">เพิ่มเข้าชั้น</button>

                                @php
        $hasFirstChapter = isset($firstChapter) && $firstChapter;
                                @endphp

                                <a href="{{ $hasFirstChapter ? route('read.read_chaptcomic', ['bookID' => $book->bookID, 'chapterID' => $firstChapter->chapterID]) : '#' }}"
                                    class="button_2 {{ $hasFirstChapter ? '' : 'disabled-button' }}"
                                    {{ $hasFirstChapter ? '' : 'aria-disabled="true"' }}>
                                    อ่านเลย
                                </a>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="Introducing">
                        <h4>แนะนำเนื้อเรื่อง</h4>
                        <p>{{ $book->book_description }}
                        </p>{{-- loopข้อมูลมาวส่สะ --}}
                    </div>
                    <div class="All_episodes">
                        <h4>ตอนทั้งหมด ( {{ $count_chapter }} )</h4>
                        <select name="" id="">
                            <option value="0">ตอนทั้งหมด</option>
                            <option value="1">ตอนล่าสุด</option>
                            <option value="2">ตอนแรก</option>
                        </select>
                        @php
        $count = 0;
                        @endphp
                        @foreach ($chapters as $chapter)
                            <div class="">
                                <hr>

                                <div class="col-8" id="sub-chap">
                                    @php
            $count += 1;
                                    @endphp
                                    <strong>{{ $count }}</strong>
                                    <img class="images" src="{{ asset($chapter->chapter_image) }}" alt="">
                                    <strong>
                                        <a href="{{ route('read.read_chaptnovel', ['bookID' => $book->bookID, 'chapterID' => $chapter->chapterID]) }}"
                                            id="edit-chapter-href">
                                            {{ $chapter->chapter_name }}
                                        </a>
                                    </strong>
                                </div>
                            </div>
                        @endforeach
                        <hr>
                    </div>
                    <div class="com">
                        <h4>ความคิดเห็นทั้งหมด ( {{ $count_comment }} )</h4>
                        @foreach ($chapters as $chapter)
                            <div class="chapter-section">
                                @foreach ($chapterComments[$chapter->chapterID] ?? [] as $comment)
                                    <div class="comment-item">
                                        <strong>{{ $comment->user->name }}</strong>:
                                        <p>{{ $comment->comment_message }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
    @endforeach


@endsection
