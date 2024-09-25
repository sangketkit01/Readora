@extends('user.layout')
@section('title', 'Add Chapter')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/user/edit_chapter.css') }}">
@endpush

@section('containerClassName', 'EditChapterContainer')
@section('content')
    <div class="container">
        <form action="{{ route('novel.chapter_update', ['bookID' => $bookID , "chapterID"=>$chapterID]) }}" id="form" method="post"
            enctype="multipart/form-data">
            @csrf

            <div class="row d-flex">
                <div class="col-2 d-flex justify-content-start">
                    <label for="image-input" id="image-input-label" style="background-image: url({{asset($book->chapter_image)}})"></label>
                    <input type="file" name="image" id="image-input" accept="image/*">
                </div>
                <div class="col-9 d-flex flex-column ms-4 add-name">
                    <label for="">ชื่อตอน</label>
                    <input type="text" name="title" id="title-name" required value="{{$book->chapter_name}}">
                </div>
            </div>

            <div class="row">
                <div class="col-12 d-flex justfy-content-start mt-5">
                    <label for="" id="content-label">ตั้งค่าสถานะเรื่อง</label>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <select name="status" id="status" class="form-control">
                        <option value="private" {{$book->chapter_status == "private" ? 'selected' : ''}}>เฉพาะฉัน</option>
                        <option value="public"  {{$book->chapter_status == "public" ? 'selected' : ''}}>สาธารณะ</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-12 d-flex justfy-content-start mt-5">
                    <label for="" id="content-label">เนื้อหา</label>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <textarea name="content" id="content"  class="ck"  cols="30" style="height: 90vh"  required >{{$book->chapter_content}}</textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-12 d-flex justfy-content-start mt-5">
                    <label for="" id="content-label">ข้อความจากนักเขียน (ไม่บังคับ)</label>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <textarea name="writer_message" id="writer_message" placeholder="เพิ่มเนื้อเรื่อง" cols="30" rows="10">{{$book->writer_message == "ไม่มีข้อความจากนักเขียน" ? "" : $book->writer_message}}</textarea>
                </div>
            </div>


            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center">
                    <a href="{{route('novel.edit',["bookID"=>$bookID])}}"  type="button" id="cancel-button">ยกเลิก</a>
                    <button type="submit" id="save-button">ยืนยัน</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/user/add_chapter.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
