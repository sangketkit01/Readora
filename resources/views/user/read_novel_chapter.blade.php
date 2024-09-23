@extends('user.layout')

@section('title', 'Home')
@push('style')
    <link rel="stylesheet" href="/css/user/read_chaptnovel.css">
@endpush
@section('containerClassName', 'indexContainer')

@section('content')

    <div class="container">
        <div class="Introducing">
            <h2>{{ $chapters->chapter_name }}</h2>
            <div class="content-box">
                {!! nl2br(e($chapters->chapter_content)) !!}
            </div>
        </div>

        <div class="button">
            @if ($previousChapter)
                <a href="{{ route('read.read_chapt', ['bookID' => $books->bookID, 'chapterID' => $previousChapter->chapterID]) }}"
                    class="btn btn-primary">ตอนก่อนหน้า</a>
            @else
                <button class="btn btn-primary" disabled>ตอนก่อนหน้า</button>
            @endif

            @if ($nextChapter)
                <a href="{{ route('read.read_chapt', ['bookID' => $books->bookID, 'chapterID' => $nextChapter->chapterID]) }}"
                    class="btn btn-primary">ตอนถัดไป</a>
            @else
                <button class="btn btn-primary" disabled>ตอนถัดไป</button>
            @endif
        </div>


        <div class="comment">
            <h4>แสดงความคิดเห็น</h4>
    <form action="{{ route('comment.insert') }}" method="POST">
        @csrf
        <input type="hidden" name="chapterID" value="{{ $chapters->id }}">
        <textarea name="comment_message" rows="5" placeholder="แสดงความคิดเห็นที่นี่...."></textarea>
        <button type="submit">ส่งความคิดเห็น</button>
    </form>
                            
                        </div>
                        <div class="com">
                            <div class="pofile_user_com">
                                <img src="{{ $books->User->profile }}
    " alt=""> 
                                <p>{{ $books->User->name }}
    </p> 
                            </div>
                            <textarea readonly>ลูปความเห็นมาใส่นี่</textarea>
        </div>
    </div>

@endsection
