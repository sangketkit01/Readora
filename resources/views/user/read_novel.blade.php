@extends('user.layout')
@section('title', 'Home')
@push('style')
    <link rel="stylesheet" href="/css/user/read.css">
@endpush
@section('containerClassName', 'indexContainer')

@section('content')

    <div class="container">
        @foreach ($novels as $novel)
            <div class="row justify-content-center">
                <div class="col-12 col-md-11">
                    <div class="row">
                        <div class="col-4">
                            <div class="image-title">
                                <img src="{{ asset($novel->novel_pic) }}" alt="">
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="add-title">
                                <p>{{ $novel->novel_name }}</p>
                                <div class="profile d-flex align-items-center">
                                    <img id="profile-image" src="{{ $novel->User->profile }}" alt="">
                                    <p for="profile-image" id="profile-name">{{ $novel->User->name }}</p>
                                </div>
                                <div class="type">
                                    <p>{{ $novel->NovelType->novelType_name }}</p>
                                </div>
                                <div class="description">
                                    <p>{{ $novel->novel_description }}</p>
                                </div>
                                <div class="d-flex flex-column justify-content-end" style="height: 100%;">
                                    <div class="col-4 d-flex">
                                        <div class="group-36 me-2">
                                            <button type="button" class="div36"
                                                style="color: rgb(93, 93, 93);">เพิ่มเข้าชั้น</button>
                                            <div class="rectangle-123"></div>
                                        </div>

                                        <div class="group-35">
                                            <div class="rectangle-127"></div>
                                            <button type="button" class="div35"
                                                style="color: rgb(255, 255, 255);">อ่านเลย</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <br>

                    <div class="row recommend" id="recci">
                        <div class="col-10">
                            <h4>แนะนำเนื้อเรื่อง</h4>
                            <p contenteditable="true" id="recommend-input">เพิ่มคำแนะนำเนื้อเรื่อง</p>
                            <textarea id="hiddenTextareaRecommend" name="recommend" style="display:none;"></textarea>
                        </div>
                    </div>
                </div>
                <br>

                <div class="content">
                    <div class="row recommend" id="chapter">
                        <div class="col-8" id="mainchap">
                            <h4>ตอนทั้งหมด( {{ $count_chapter }} )</h4>
                            <select class="srt" name="srt" id="srt" value="">
                                <option value="0">เรียงลำดับตอน</option>
                                <option value="1">ตอนล่าสุด</option>
                                <option value="2">ตอนแรก</option>
                            </select>
                        </div>
                    </div>
                    <div class="row recommend justify-content-between" id="chap">
                        <hr>
                        @php
                            $count = 0;
                        @endphp
                        @foreach ($chapters as $chapter)
                            <div class="col-8" id="sub-chap">
                                @php
                                    $count += 1;
                                @endphp
                                <strong>{{ $count }}</strong>
                                <strong><a href="#" id="edit-chapter-href">{{ $chapter->chapter_name }}</a></strong>
                            </div>
                        @endforeach
                        <hr>
                    </div>
                    <br><br>
                    <div class="row recommend opn" id="chapter" style="margin-bottom: 200px; backgroung-color: #ffffff;">
                        <div class="col-12">
                            <h4>แสดงความคิดเห็น</h4>
                            <div class="col-12">
                                <textarea class="input-area" name="opn" id="opn" cols="30" rows="10"
                                    placeholder="แสดงความคิดเห็นที่นี้..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="com">
                    <div class="profile">
                        <img id="profile-image" src="{{ $novel->User->profile }}" alt="">
                        <p for="profile-image" id="profile-name">{{ $novel->User->name }}</p>
                    </div>
                    <textarea class="output-area" name="opn" id="opn" cols="30" rows="5" readonly>ลูปความเห็นมาใส่นี่</textarea>
                </div>
            </div>
        @endforeach

    @endsection
