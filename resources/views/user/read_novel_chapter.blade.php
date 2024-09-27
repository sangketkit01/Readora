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
                {!! nl2br($chapters->chapter_content) !!}
                <br><br><br>
                <div class="writer-message">
                    <strong>Writer:</strong> {{ $chapters->writer_message ?? 'No message from the writer.' }}
                </div>
            </div>
            <br>
            <br><br><br><br>
            <div class="pofile_user_com">
                <img src="{{ asset($books->User->profile) }}" alt="" style="object-fit: cover">
                <p>{{ $books->User->name }}</p>
            </div><br>
            <div class="button">
                @if ($previousChapter)
                    <a href="{{ route('read.read_chaptnovel', ['bookID' => $books->bookID, 'chapterID' => $previousChapter->chapterID]) }}"
                        class="btn btn-primary">ตอนก่อนหน้า</a>
                @else
                    <button class="btn btn-primary" disabled>ตอนก่อนหน้า</button>
                @endif
    
                @if ($nextChapter)
                    <a href="{{ route('read.read_chaptnovel', ['bookID' => $books->bookID, 'chapterID' => $nextChapter->chapterID]) }}"
                        class="btn btn-primary">ตอนถัดไป</a>
                @else
                    <button class="btn btn-primary" disabled>ตอนถัดไป</button>
                @endif
            </div>
        </div>

    
        <div class="comment">
            <h4>แสดงความคิดเห็น</h4>
            <form action="/commentcomic/{{$books->bookID}}/{{$chapters->chapterID }}" method="post">
                @csrf
                <textarea name="comment_message" rows="5" placeholder="แสดงความคิดเห็นที่นี่....." required></textarea>
                <button type="submit">ส่งความคิดเห็น</button>
            </form>
        </div>
        <div class="com">
            <h4>ความคิดเห็นทั้งหมด ({{ $commentCount }})</h4>

            @foreach ($chapterComments as $comment)
                <div class="comment-item">
                    <strong>{{ $comment->user->name }}</strong>:
                    <p>{{ $comment->comment_message }}</p>
                </div>
            @endforeach
        </div>
    </div>

@endsection
