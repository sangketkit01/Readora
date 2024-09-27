@extends('user.layout')
@section('title', 'Add Chapter')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/user/add_chapter.css') }}">
@endpush

@section('containerClassName', 'AddChapterContainer')
@section('content')
    <div class="container">
        <a href="{{route("novel.edit",["bookID"=>$bookID])}}" id="back-icon"><i class="bi bi-arrow-left-circle-fill fs-1"></i> </a>
        <form action="{{ route('novel.new_chapter', ['bookID' => $bookID]) }}" id="form" method="post"
            enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="hidden_content" id="hidden_content">
            <div class="row d-flex">
                <div class="col-2 d-flex justify-content-start">
                    <label for="image-input" id="image-input-label"></label>
                    <input type="file" name="image" id="image-input" accept="image/*" required>
                </div>
                <div class="col-9 d-flex flex-column ms-4 add-name">
                    <label for="">ชื่อตอน</label>
                    <input type="text" name="title" id="title-name" required> 
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
                        <option value="private">เฉพาะฉัน</option>
                        <option value="public">สาธารณะ</option>
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
                    <textarea name="content" id="content"  cols="30"
                        style="height: 90vh" class="ck form-control"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-12 d-flex justfy-content-start mt-5">
                    <label for="" id="content-label">ข้อความจากนักเขียน (ไม่บังคับ)</label>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <textarea name="writer_message" id="writer_message" placeholder="เพิ่มข้อความ" cols="30"
                        rows="10"></textarea>
                </div>
            </div>


            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center">
                    <a href="{{ route('novel.edit', ['bookID' => $bookID]) }}" type="button" id="cancel-button"
                        style="text-decoration:none;">ยกเลิก</a>
                    <button type="submit" id="save-button">ยืนยัน</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/user/add_chapter.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('form');
            const hiddenContent = document.getElementById('hidden_content');

            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const content = tinymce.get('content').getContent();
                    hiddenContent.value = content;
                    if (content.trim() === '') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Content cannot be empty',
                        });
                    } else {
                        this.submit();
                    }
                });
            }
        });
    </script>

@endpush
