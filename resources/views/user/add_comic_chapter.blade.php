@extends('user.layout')
@section('title', 'Add Chapter')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/user/add_comic_chapter.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
@endpush

@section('containerClassName')
@section('content')
    <div class="container">
         <a href="{{route("comic.edit",["bookID"=>$bookID])}}" id="back-icon"><i class="bi bi-arrow-left-circle-fill fs-1"></i> </a>
        <form action="{{ route('comic.new_chapter', ['bookID' => $bookID]) }}" id="form" method="post"
            enctype="multipart/form-data">
            @csrf

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
                        <option value="public">สาธารณะ</option>
                        <option value="private">เฉพาะฉัน</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-12 d-flex justfy-content-start mt-5">
                    <label for="" id="content-label">ข้อความจากนักเขียน (ไม่บังคับ)</label>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <textarea name="writer_message" id="writer_message" placeholder="เพิ่มข้อความ" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-start mt-5">
                    <label for="" id="content-label">เนื้อหา (PDF)</label>
                </div>
            </div>

            <div class="row">
                <div class="col-12 div-content-upload d-flex flex-column justify-content-center align-items-center">
                    <input type="file" name="pdf" id="content-upload" class="form-control content-upload" accept="application/pdf" required>
                    <div id="output" class="d-flex justify-content-center align-items-center flex-column"></div> 
                </div>
            </div>


            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center">
                    <a href="{{route('comic.edit',['bookID'=>$bookID])}}" type="button" id="cancel-button" style="text-decoration: none">ยกเลิก</a>
                    <button type="submit" id="save-button">ยืนยัน</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/user/add_comic_chapter.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
