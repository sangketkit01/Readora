@extends('user.layout')
@section('title', 'Edit Novel')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/user/edit_comic.css') }}">
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
@section('containerClassName', 'editNovelContainer')
@section('content')

    @if (session('successMsg'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: `{!! nl2br(e(session('successMsg'))) !!}`,
                    showConfirmButton: false,
                    timer: 5000
                });
            });
        </script>
    @endif

    <div class="container">
        <form action="{{ route('comic.edit_insert', ['bookID' => $bookID]) }}" method="post" id="form"
            enctype="multipart/form-data" class="form-group">
            @csrf
            <div class="d-flex flex-column">
                <a href="{{route("profile.comic")}}" id="back-icon"><i class="bi bi-arrow-left-circle-fill fs-1"></i> </a>
                <h2 style="margin-top: 20px">แก้ไข {{ $data->book_name }}</h2>
                <div>
                    <label for="" class="form-label">ชื่อเรื่อง</label>
                    <input type="text" name="title" class="form-control" required value="{{ $data->book_name }}">
                </div>
                <div>
                    <label for="" class="form-label mt-3">แนะนำเรื่อง</label>
                    <textarea name="book_description" class="form-control" id="" cols="100" rows="8" required>{{ $data->book_description }}</textarea>
                </div>
                <div>
                    <label for="" class="form-label mt-3">ตั้งค่าสถานะเรื่อง</label>
                    <select name="status" id="" class="form-control">
                        <option value="private" {{ $data->book_status == "private" ? 'selected' : '' }}>เฉพาะฉัน</option>
                        <option value="public" {{ $data->book_status == "public" ? 'selected' : '' }}>สาธารณะ</option>
                    </select>
                </div>
                <div>
                    <label for="" class="form-label mt-3">เลือกหมวดหมู่</label>
                    <select name="type" id="" class="form-control">
                        @foreach ($book_genres as $genre)
                            <option value="{{ $genre->bookGenreID }}"
                                {{ $data->bookGenreID == $genre->bookGenreID ? 'selected' : '' }}>{{ $genre->bookGenre_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex mt-4">
                    <input type="button" onclick="submitForm()" value="อัปเดตคอมมิค" class="btn btn-primary me-2">
                    @if ($chapters->isEmpty())
                        <button class="btn btn-danger ms-2" type="button" onclick="DeleteComic('{{ $data->book_name }}')">ลบคอมมิค</button>
                    @endif
                </div>
            </div>

            <div class="d-flex flex-column mt-3">
                <div class="cover-upload">
                    <label for="inputImage" id="input-image-label"
                        style="background-image:url({{ asset($data->book_pic) }})"></label>
                    <input type="file" name="inputImage" id="inputImage" accept="image/*">
                </div>
                <div class="d-flex flex-row align-item-center justify-content-center">
                    <img id="profile-image" src="{{ asset(session('user')->profile) }}" alt="" style="object-fit: cover">
                    <label id="profile-name" for="">{{ session('user')->name }}</label>
                </div>
            </div>

        </form>

        <form action="{{route('comic.delete',["bookID"=>$bookID])}}" method="post" id="delete-form" class="form" style="display:none;">@csrf</form>

    </div>

    <div class="container" style="margin-top: 50px">
        <h4 class="ms-4">ตอนทั้งหมด {{ $count_chapter }}</h4>
        <div class="d-flex ms-4">
            <div class="d-flex align-items-center">
                <input type="checkbox" name="chap" class="chap form-check-input">
                <select name="chapter" class="chap ms-3 form-control">
                    <option value="0">จัดการตอน</option>
                </select>
                <select name="srt" class="ms-3 form-control text-center" style="width:125px">
                    <option value="0">เรียงลำดับตอน</option>
                    <option value="1">ตอนล่าสุด</option>
                    <option value="2">ตอนแรก</option>
                </select>
            </div>
            <div class="d-flex ms-auto me-4">
                <button type="button" class="div37 text-white ms-3"
                    onclick="window.location.href = '/add_comic_chapter/{{ $bookID }}'">เพิ่มตอนใหม่</button>
            </div>
        </div>

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
                        <input type="checkbox" name="chap" class="chap form-check-input mb-1">
                        <strong>{{ $count }}</strong>
                        <img class="images" src="{{ asset($chapter->chapter_image) }}" alt="">
                        <strong><a class="chapter-name" href="/edit_comic_chapter/{{ $bookID }}/{{ $chapter->chapterID }}">{{ $chapter->chapter_name }}</a></strong>
                    </div>
                    <div class="d-flex ms-auto me-4 align-items-center">
                        <form action="{{ route('comic.chapter_status_update', ['bookID' => $bookID, 'chapterID' => $chapter->chapterID]) }}"
                            class="chapter-form" method="POST">

                            @csrf

                            <select name="status_chapter" class="pub-chapter form-control me-2">
                                <option value="private" {{ $chapter->chapter_status == "private" ? 'selected' : '' }}>เฉพาะฉัน
                                </option>
                                <option value="public" {{ $chapter->chapter_status == "public" ? 'selected' : '' }}>สาธารณะ
                                </option>
                            </select>
                        </form>
                         <button type="button" onclick="DeleteChapter('{{$chapter->chapter_name}}', '{{ $chapter->chapterID }}')" id="delete-chapter"><img src="{{asset('novel/delete.png')}}" width="35" alt=""></button>
                         <form action="{{route('comic.delete_chapter',["bookID"=>$bookID,"chapterID"=>$chapter->chapterID])}}" 
                            id="delete-chapter-form-{{ $chapter->chapterID }}" method="post" style="display: none;">@csrf</form>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
    </div>
    <div class="d-flex justify-content-center align-items-center mt-4">
        <button type="button" class="div37 text-white" onclick="window.location.href = `{{route('comic.trash',['bookID'=>$bookID])}}`">ดูถังขยะ</button>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/user/edit_comic.js') }}"></script>
@endpush