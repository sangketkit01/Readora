@extends('user.layout')
@section('title', 'Edit Novel')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/user/edit_novel.css') }}">
@endpush
@section('containerClassName', 'editNovelContainer')
@section('content')
    <div class="container">
        <form action="{{ route('novel.edit_insert', ['bookID' => $bookID]) }}" method="post" id="form"
            enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center row-header align-items-center">
                <div class="col-7">
                    <div class="header-left d-flex align-items-center" style="margin-top: 12px;">
                        <p class="ms-4 me-2">ตั้งค่าสถานะเรื่อง</p>
                        <select name="status" id="pub">
                            <option value="0" {{ $data->book_status == 0 ? 'selected' : '' }}>เฉพาะฉัน</option>
                            <option value="1" {{ $data->book_status == 1 ? 'selected' : '' }}>สาธารณะ</option>
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
                                <label for="inputImage" id="input-image-label"
                                    style="background-image: url({{ asset($data->book_pic) }})"></label>
                                <input type="file" id="inputImage" name="inputImage" accept="image/*">
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="add-title">
                                <label contenteditable="true" id="add-title-input">{{ $data->book_name }}</label>
                                <textarea id="hiddenTextareaTitle" name="title" style="display:none;"></textarea>
                                <div class="profile d-flex align-items-center">
                                    <img id="profile-image-edit" src="{{ session('user')->profile }}" alt="">
                                    <p for="profile-image" id="profile-name-edit">{{ session('user')->name }}</p>
                                </div>
                                <div class="type">
                                    <select name="type" id="type">
                                        @foreach ($book_types as $type)
                                            @if ($data->bookTypeID == $type->bookTypeID)
                                                <option value="{{ $type->bookTypeID }}" selected>
                                                    {{ $type->bookType_name }}</option>
                                            @else
                                                <option value="{{ $type->bookTypeID }}">{{ $type->bookType_name }}
                                                </option>
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
                            <p contenteditable="true" id="recommend-input">{{ $data->book_description }}</p>
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
                            <h4>ตอนทั้งหมด( {{ $count_chapter }} )</h4>
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
                                <button type="button" class="div37" style="color: rgb(255, 255, 255);"
                                    onclick="window.location.href = '/add_chapter/{{ $bookID }}'">เพิ่มตอนใหม่</button>
                            </div>
                        </div>
                        <hr>
                    </div>
        </form>
        <div class="row recommend justify-content-between">
            @php
                $count = 0;
            @endphp

            @foreach ($chapters as $chapter)
                @php
                    $count += 1;
                @endphp
                <div class="col-8" id="sub-chap">
                    <input type="checkbox" name="chap" id="chap" class="chap">
                    <strong>{{ $count }}</strong>
                    <img class="images" src="{{ asset($chapter->chapter_image) }}" alt="">
                    <strong><a href="/edit_chapter/{{ $bookID }}/{{ $chapter->chapterID }}"
                            id="edit-chapter-href">{{ $chapter->chapter_name }}</a></strong>
                </div>
                <div class="col-4 text-end">
                    <div class="header-left d-flex align-items-center" style="margin-top: 12px;">
                        <i class="bi bi-eye"></i>
                        <form action="{{route('novel.novel_chapter_update',["bookID"=>$bookID,"chapterID"=>$chapter->chapterID])}}" id="chapter-form" method="POST">
                            @csrf
                            <select name="status-chapter" id="pub-chapter">
                                <option value="0">เฉพาะฉัน</option>
                                @if ($chapter->allow_comment == 1)
                                    <option value="1" selected>สาธารณะ</option>
                                @else
                                    <option value="1">สาธารณะ</option>
                                @endif
                            </select>
                        </form>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/user/edit_novel.js') }}"></script>
@endpush
