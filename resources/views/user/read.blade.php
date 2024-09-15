@extends('user.layout')
@section('title', 'Home')
@push('style')
    <link rel="stylesheet" href="/css/user/read.css">
@endpush
@section('containerClassName', "indexContainer")

@section('content')

<div class="container">

        <div class="row justify-content-center">
            <div class="col-12 col-md-11">
                <div class="row">
                    <div class="col-4">
                        <div class="image-title text-center">
                            <img src="{{asset($book->book_pic)}}" alt="">
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="add-title">
                            <p>{{$book->book_name}}</p>
                            <div class="profile d-flex align-items-center">
                                <img id="profile-image" src="{{session('user')->profile}}" alt="">
                                <p for="profile-image" id="profile-name">{{session('user')->name}}</p>
                            </div>
                            <div class="type">
                                <p>{{$book->bookType_name}}</p>
                            </div>
                            <div class="description">
                                <p>{{$book->book_description}}</p>
                            </div>
                            <div class="d-flex flex-column justify-content-end" style="height: 100%;">
                                <div class="col-4 d-flex">
                                    <div class="group-36 me-2">
                                        <button type="button" class="div36" style="color: rgb(93, 93, 93);">เพิ่มเข้าชั้น</button>
                                        <div class="rectangle-123"></div>
                                    </div>
                            
                                    <div class="group-35">
                                        <div class="rectangle-127"></div>
                                        <button type="button" class="div35" style="color: rgb(255, 255, 255);">อ่านเลย</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <br>

                <div class="row recommend">
                    <div class="col-10">
                        <h4>แนะนำเนื้อเรื่อง</h4>
                        <p contenteditable="true" id="recommend-input">เพิ่มคำแนะนำเนื้อเรื่อง</p>
                        <textarea id="hiddenTextareaRecommend" name="recommend" style="display:none;"></textarea>
                    </div>
                </div>
            </div>
            <div class="row recommend" id="chapter">
                <div class="col-8" id="mainchap">
                    <h4>ตอนทั้งหมด( {{$count_chapter}} )</h4>
                    <select class="srt" name="srt" id="srt" value="">
                        <option value="0">เรียงลำดับตอน</option>
                        <option value="1">ตอนล่าสุด</option>
                        <option value="2">ตอนแรก</option>
                    </select>
                </div>
            </div>
            <div class="row recommend justify-content-between" id="chap">
                <hr>
                <div class="col-8" id="sub-chap">
                    <strong>{{ $count }}</strong>
                    <strong><a href="#" id="edit-chapter-href">{{$chapter->chapter_name}}</a></strong>
                </div>
                <hr>
            </div>
            <br><br>
            <div class="row recommend opn" id="chapter" style="margin-bottom: 200px;">
                <div class="" id="opn">
                    <h4>แสดงความคิดเห็น</h4>
                    <textarea class="input-area" name="opn" id="opn" cols="30" rows="10" rows="5"
                        placeholder="แสดงความคิดเห็นที่นี้..."></textarea>
                </div>
            </div>
            <div class="com">
                <div class="profile">
                    <img id="profile-image" src="{{session('user')->profile}}" alt="">
                    <p for="profile-image" id="profile-name">{{session('user')->name}}</p>
                </div>
                <textarea class="output-area" name="opn" id="opn" cols="30" rows="5" readonly>ลูปความเห็นมาใส่นี่</textarea>
            </div>
        </div>

@endsection