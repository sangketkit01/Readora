@extends("user.layout")
@section("title", "Edit Novel")
@push("style")
    <link rel="stylesheet" href="{{asset('css/user/edit_novel.css')}}">
@endpush
@section("containerClassName", "editNovelContainer")
@section("content")
<div class="container">
    <form action="{{route('novel.insert')}}" method="post" id="form" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-center row-header">
            <div class="col-7">
                <div class="header-left d-flex align-items-center" style="margin-top: 12px;">
                    <p class="me-2">ตั้งค่าสถานะเรื่อง</p>
                    <select name="status" id="pub">
                        <option value="0">เฉพาะฉัน</option>
                        <option value="1">สาธารณะ</option>
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
        @foreach ($data as $item)
        <div class="row justify-content-center">
            <div class="col-12 col-md-11">
                <div class="row">
                    <div class="col-4">
                        <div class="image-title text-center">
                                <label for="inputImage" id="input-image-label" style="background-image: url({{asset($item->book_pic)}})"></label>
                            <input type="file" id="inputImage" required name="inputImage" accept="image/*">
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="add-title">
                            <label contenteditable="true" id="add-title-input">{{$item->book_name}}</label>
                            <textarea id="hiddenTextareaTitle" name="title" style="display:none;"></textarea>
                            <div class="profile d-flex align-items-center">
                                <img id="profile-image" src="{{session('user')->profile}}" alt="">
                                <p for="profile-image" id="profile-name">{{session('user')->name}}</p>
                            </div>
                            <div class="type">
                                <select name="type" id="type">
                                    @foreach ($book_types as $type)
                                        @if ($item->bookTypeID == $type->bookTypeID)
                                            <option value="{{$type->bookTypeID}}" selected>{{$type->bookType_name}}</option>
                                        @else
                                             <option value="{{$type->bookTypeID}}">{{$type->bookType_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
                </div> <br>

                <div class="row recommend justify-content-between" id="rec">
                    <div class="col-8">
                        <h4>แนะนำเนื้อเรื่อง</h4>
                        <p contenteditable="true" id="recommend-input">เพิ่มคำแนะนำเนื้อเรื่อง</p>
                        <textarea id="hiddenTextareaRecommend" name="recommend" style="display:none;"></textarea>
                    </div>
                    <div class="col-4 text-end">
                        <div class="group-36">
                            <button type="button" class="div36"
                                style="color: rgb(140, 140, 140);">แก้ไขแนะนำเรื่อง</button>
                            <div class="rectangle-123"></div>
                        </div>
                        <div class="group-35">
                            <div class="rectangle-127"></div>
                            <button type="button" class="div35"
                                style="color: rgb(255, 255, 255);">เพิ่มแนะนำเรื่อง</button>
                        </div>
                    </div>
                </div> <br>

                <div class="row recommend justify-content-between" id="chapter">
                    <div class="col-8" id="mainchap">
                        <h4>ตอนทั้งหมด( )</h4>
                        <input type="checkbox" name="chap" id="chap" class="chap">
                        <select class="chap" name="chapter" id="chap" value="">
                            <option value="0">จัดการตอน</option>
                            <option value=""></option>
                        </select>
                        <select class="srt" name="srt" id="srt" value="">
                            <option value="0">เรียงลำดับตอน</option>
                            <option value="1">ตอนล่าสุด</option>
                            <option value="2">ตอนแรก</option>
                        </select>
                    </div>
                    <div class="col-4 text-end">
                        <div class="group-37">
                            <div class="rectangle-128"></div>
                            <button type="button" class="div37" style="color: rgb(255, 255, 255);">เพิ่มตอนใหม่</button>
                        </div>
                    </div>
                    <hr>
                </div>

                <div class="row recommend justify-content-between">
                    <div class="col-8" id="sub-chap">
                        <input type="checkbox" name="chap" id="chap" class="chap">
                        <strong>1</strong>
                        <img src="{{asset('storage\Picture\66e013e65e6c94.92140139.jpg')}}" alt="">
                        <strong>มิโดริยะ</strong>
                    </div>
                    <div class="col-4 text-end">
                        <div class="header-left d-flex align-items-center" style="margin-top: 12px;">
                            <i class="bi bi-eye"></i>
                            <select name="status" id="pub">
                                <option value="0">เฉพาะฉัน</option>
                                <option value="1">สาธารณะ</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
             @endforeach
    </form>
</div>
@endsection

@push("scripts")
    <script src="{{asset('js/user/edit_novel.js')}}"></script>
@endpush
