@extends("user.layout")
@section("title","Add Chapter")
@push("style")
    <link rel="stylesheet" href="{{asset("css/user/add_chapter.css")}}">
@endpush

@section("containerClassName","AddChapterContainer")
@section("content")
    <form action="{{route("novel.new_chapter",["novelID"=>$novelID])}}" id="form" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row button-header">
            <div class="col-12 d-flex justify-content-end">
                <button type="button" id="edit-button">แก้ไข</button>
                <button type="button" id="submit-button" onclick="submitForm()">ยืนยัน</button>
            </div>
        </div>

        <div class="row d-flex">
            <div class="col-2 d-flex justify-content-start">
                <label for="image-input" id="image-input-label"></label>
                <input type="file" name="image" id="image-input" accept="image/*" required>
            </div>
            <div class="col-9 d-flex flex-column ms-4 add-name">
                <label for="">ชื่อตอน</label>
                <input type="text" name="title" id="title-name">
            </div>
        </div>

        <div class="row">
            <div class="col-12 d-flex justfy-content-start mt-5">
                <label for="" id="content-label">เนื้อหา</label>
            </div>
        </div>

        <div class="row">
            <div class="col-12 d-flex flex-column mt-2 bg-white">
                <textarea name="content" id="content" placeholder="เพิ่มเนื้อเรื่อง" cols="30" rows="15"></textarea>
                <hr id="content-hr">
                <div class="row d-flex align-item-center" id="check-error">
                    <div class="col-6 d-flex">
                        <p class="ms-3">0 ตัวอักษร</p>
                        <p class="ms-2">0 คำ</p>
                        <p class="ms-2">0 หน้า</p>
                    </div>

                    <div class="col-6 d-flex justify-content-end ml-2">
                        <button class="btn btn-primary">ตรวจคำผิด</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 d-flex justfy-content-start mt-5">
                <label for="" id="content-label">ข้อความจากนักเขียน</label>
            </div>
        </div>

         <div class="row">
            <div class="col-12 d-flex flex-column mt-2 bg-white">
                <textarea name="writer_message" id="writer_message" placeholder="เพิ่มเนื้อเรื่อง" cols="30" rows="10"></textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-12 d-flex justfy-content-start mt-5">
                <label for="" id="content-label">ตั้งค่าตอน</label>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12 d-flex align-item-center">
                <input type="checkbox" id="checkbox" name="allow_comment">
                <label for="" class="ms-2">อณุญาตให้แสดงความคิดเห็น</label>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center">
                <button id="cancel-button">ยกเลิก</button>
                <button id="save-button">บันทึกแบบร่าง</button> 
            </div>
        </div>
    </form>
@endsection

@push("scripts")
    <script src="{{asset('js/user/add_chapter.js')}}"></script>
@endpush