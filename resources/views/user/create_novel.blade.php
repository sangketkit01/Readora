@extends('user.layout') @section('title','Create Novel') @push('style')
<link rel="stylesheet" href="/css/user/create_novel.css" />
@endpush @section('containerClassName',"createNovelContainer")
@section('content')
<div class="header-top">
    <form action="" method="post">
        <div class="header">
            <div class="header-left">
                <p>ตั้งค่าสถานะเรื่อง</p>
                <select name="status" id="">
                    <option value="0">เฉพาะฉัน</option>
                    <option value="1">สาธารณะ</option>
                </select>
            </div>
    
            <div class="header-right">
                <a href="#">แก้ไข</a>
                <a href="#">ดูตัวอย่าง</a>
            </div>
    
        </div>

        <div class="cover">
            <img src="" alt="" id="cover-image">
            <label for="inputImage" id="input-image-label"></label>
            <input type="file" id="inputImage">
        </div>

    </form>
</div>
@endsection @push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let inputImageLabel = document.getElementById("input-image-label");
        let inputImage = document.getElementById("inputImage");

        const maxFileSize = 10 * 1024 * 1024;
        inputImage.addEventListener("change", (event) => {
            const file = event.target.files[0];

            if (file && file.type.startsWith('image/')) {
                if (file.size > maxFileSize) {
                    alert("ขนาดไฟล์ต้องไม่เกิน 10 MB");
                    return;
                }

                const imageUrl = URL.createObjectURL(file);
                inputImageLabel.style.backgroundImage = `url(${imageUrl})`;
            }
        });
    });
</script>
@endpush
