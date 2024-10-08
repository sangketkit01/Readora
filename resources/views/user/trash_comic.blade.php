@extends('user.layout')
@section('title', 'Trashed Chapters')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/user/trash_novel.css') }}">
@endpush
@section('containerClassName', 'TrashNovelContainer')
@section('content')
    @if ($chapters->isEmpty())
        <div class="d-flex justify-content-center align-items-center" style="height: 90vh"><label for="" style="font-size: 22px">ไม่มีตอนที่ถูกลบ</label></div>
    @else
        <div class="container" style="margin-top: 50px">
            <h4 class="ms-4">ตอนทั้งหมด {{ $count_chapter }}</h4>

            <div class="d-flex flex-column justify-content-between">
                @php
                    $count = 0;
                @endphp

                @foreach ($chapters as $chapter)
                    @php
                        $count += 1;
                    @endphp
                    <div class="d-flex">

                        <div class="d-flex ms-4 mt-3 align-items-center">
                            <strong>{{ $count }}</strong>
                            <img class="images" src="{{ asset($chapter->chapter_image) }}" alt="">
                            <strong><a class="chapter-name">{{ $chapter->chapter_name }}</a></strong>
                        </div>
                        <div class="d-flex ms-auto me-4 align-items-center">
                            <button class="btn btn-primary" type="button"
                                onclick="RestoreEach({{$chapter->chapterID}},'{{$chapter->chapter_name}}')">กู้คืน</button>
                            <form action="{{route("comic.restore_each",["bookID" => $bookID , "chapterID" => $chapter->chapterID])}}" style="display: none;" method="POST"
                                id="restore-each-{{ $chapter->chapterID }}">@csrf</form>
                                
                            <button class="btn btn-danger ms-2" type="button"
                                onclick="ForceDeleteEach({{$chapter->chapterID}},'{{$chapter->chapter_name}}')">ลบถาวร</button>
                            <form action="{{route("comic.force-delete-each",["bookID" => $bookID , "chapterID" => $chapter->chapterID])}}" style="display: none;" method="POST"
                                id="force-delete-each-{{ $chapter->chapterID }}">@csrf</form>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection

@push('scripts')
    <script src="{{ asset('js/user/trash.js') }}"></script>
@endpush
