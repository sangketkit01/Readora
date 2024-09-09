@extends('user.layout') 
@section('title','Create Novel') 
@push('style')
<link rel="stylesheet" href="/css/user/create_novel.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
@endpush 
@section('containerClassName',"createNovelContainer")
@section('content')
<div class="container">
    <form action="{{route('novel.insert')}}" method="post" enctype="multipart/form-data">
        <div class="row justify-content-center row-header">
            <div class="col-7">
                <div class="header-left">
                    <p>ตั้งค่าสถานะเรื่อง</p>
                    <select name="status" id="">
                        <option value="0">เฉพาะฉัน</option>
                        <option value="1">สาธารณะ</option>
                    </select>
                </div>
            </div>

            <div class="col-3 ms-3">
                <div class="header-right">
                    <a href="#" id="edit-button">แก้ไข</a>
                    <a href="#" id="watch-example-button">ดูตัวอย่าง</a>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
                <div class="row">
                    <div class="col-4">
                        <div class="image-title text-center">
                            <img src="" alt="" id="cover-image" />
                            <label for="inputImage" id="input-image-label"></label>
                            <input type="file" id="inputImage" />
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="add-title">
                            <label contenteditable="true">เพิ่มชื่อเรื่อง</label>
                            <div class="profile d-flex align-items-center">
                                <img id="profile-image" src="{{session('user')->profile}}" alt="">
                                <p for="profile-image" id="profile-name">{{session('user')->name}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row recommend justify-content-between">
                        <div class="col-8">
                            <h4>แนะนำเนื้อเรื่อง</h4>
                        </div>
                        <div class="col-4">
                            <a href="" id="edit-recommend">แก้ไขแนะนำเนื้อเรื่อง</a>
                            <a href="" id="add-recommend">เพิ่มแนะนำเนื้อเรื่อง</a>
                        </div>
                </div>
            </div>
        </div>

    </form>
    <!-- <form action="" method="post">
        <div class="header">
            <div class="header-left">
                <p>ตั้งค่าสถานะเรื่อง</p>
                <select name="status" id="">
                    <option value="0">เฉพาะฉัน</option>
                    <option value="1">สาธารณะ</option>
                </select>
            </div>
    
            <div class="header-right">
                <a href="#" id="edit-button">แก้ไข</a>
                <a href="#" id="watch-example-button">ดูตัวอย่าง</a>
            </div>
    
        </div>

        <div class="main">
            <div class="cover">
                <div class="image-title">
                    <img src="" alt="" id="cover-image">
                    <label for="inputImage" id="input-image-label"></label>
                    <input type="file" id="inputImage">
                </div>
                <div class="add-title">
                    <label contenteditable="true">เพิ่มชื่อเรื่อง</label>
                    <div class="profile">
                        <img id="profile-image" src="{{session('user')->profile}}" alt="">
                        <p for="profile-image" id="profile-name">{{session('user')->name}}</p>
                    </div>
                </div>
            </div>

            <div class="recommend">
                <div class="header-recommend">
                    <h4>แนะนำเนื้อเรื่อง</h4>
                </div>

                <div class="recommend-button">
                    <a href="" id="edit-recommend">แก้ไขแนะนำเนื้อเรื่อง</a>
                    <a href="" id="add-recommend">เพิ่มแนะนำเนื้อเรื่อง</a>
                </div>
            </div>
        </div>

    </form> -->
</div>
@endsection 
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let inputImageLabel = document.getElementById("input-image-label");
        let inputImage = document.getElementById("inputImage");

        const maxFileSize = 10 * 1024 * 1024;
        inputImage.addEventListener("change", (event) => {
            const file = event.target.files[0];

            if (file && file.type.startsWith("image/")) {
                if (file.size > maxFileSize) {
                    alert("ขนาดไฟล์ต้องไม่เกิน 10 MB");
                    return;
                }

                const imageUrl = URL.createObjectURL(file);
                inputImageLabel.style.backgroundImage = `url(${imageUrl})`;
                //inputImageLabel.style.backgroundColor = 'transparent';
                inputImageLabel.style.backgroundSize = "contain";

                inputImage.style.display = "inline-block";
            }
        });
    });
</script>
@endpush