@extends('user.layout') 
@section('title', 'Create Novel') 
@push('style')
<link rel="stylesheet" href="/css/user/create_novel.css" />
@endpush 
@section('containerClassName', "createNovelContainer")
@section('content')
<div class="container">
    <form action="{{route('novel.insert')}}" method="post" id="form" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-center row-header">
            <div class="col-7">
                <div class="header-left d-flex align-items-center" style="margin-top: 12px;">
                    <p class="me-2">ตั้งค่าสถานะเรื่อง</p>
                    <select name="status" id="">
                        <option value="0">เฉพาะฉัน</option>
                        <option value="1" selected>สาธารณะ</option>
                    </select>
                </div>
            </div>

            <div class="col-3 ms-3">
                <div class="header-right">
                    <a href="#" id="edit-button">แก้ไข</a>
                    <button type="button" onclick="submitForm()" id="submit-button">ยืนยัน</button>
                </div>
            </div>
        </div> <br>

        <div class="row justify-content-center">
            <div class="col-12 col-md-11">
                <div class="row">
                    <div class="col-4">
                        <div class="image-title text-center">
                            <label for="inputImage" id="input-image-label"></label>
                            <input type="file" id="inputImage" required name="inputImage" accept="image/*">
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="add-title">
                            <label contenteditable="true" id="add-title-input">เพิ่มชื่อเรื่อง</label>
                            <textarea id="hiddenTextareaTitle" name="title" style="display:none;"></textarea>
                            <div class="profile d-flex align-items-center">
                                <img id="profile-image" src="{{session('user')->profile}}" alt="">
                                <p for="profile-image" id="profile-name">{{session('user')->name}}</p>
                            </div>
                            <div class="type">
                                <select name="type" id="type">
                                    @foreach ($novel_types as $type)
                                        <option value="{{$type->novelTypeID}}">{{$type->novelType_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div> <br>

                <div class="row recommend justify-content-between">
                    <div class="col-8">
                        <h4>แนะนำเนื้อเรื่อง</h4>
                        <p contenteditable="true" id="recommend-input">เพิ่มคำแนะนำเนื้อเรื่อง</p>
                        <textarea id="hiddenTextareaRecommend" name="recommend" style="display:none;"></textarea>
                    </div>
                    <div class="col-4 text-end">
                        <div class="group-36">
                            <button type="button" class="div36" style="color: rgb(140, 140, 140);">แก้ไขแนะนำเรื่อง</button>
                            <div class="rectangle-123"></div>
                        </div>

                        <div class="group-35">
                            <div class="rectangle-127"></div>
                            <button type="button" class="div35" style="color: rgb(255, 255, 255);">เพิ่มแนะนำเรื่อง</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </form>
</div>
@endsection 
@push('scripts')
<script src="{{asset("js/user/create_novel.js")}}"></script>
@endpush