@extends('user.layout')
@section('title', 'Home')
@push('style')
    <link rel="stylesheet" href="/css/user/read.css">
@endpush
@section('containerClassName', 'indexContainer')

@section('content')
    @foreach ($chapters as $chapter)
    <div class="container">
        <div class="header">
            <h1>{{ $chapter->chapter_name }}</h1>
            <p> {!! $chapter->chapter_content !!} <\p>
        </div>
        <div class="buttons">
            <button class="button">ตอนก่อนหน้า</button>
            <button class="button">ตอนถัดไป</button>
        </div>
        <div class="comments">
            <div class="comments-header">
                <h2>เพิ่มความเห็น</h2>
            </div>
            <div class="comment">
                <div class="comment-content">
                    <p class="comment-author">ชื่อนักเขียน</p>
                    <p class="comment-date">ติดตาม</p>
                </div>
            </div>
            <div class="comment-form">
                <form>
                    <div class="form-group">
                        <label for="comment" class="form-label">emoji img</label>
                        <textarea id="comment" class="form-input" name="comment"></textarea>
                    </div>
                    <button type="submit" class="form-submit">ส่งความคิดเห็น</button>
                </form>
            </div>
        </div>
    </div>
            
    @endforeach

@endsection