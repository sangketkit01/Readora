@extends('user.layout')
@section('title', 'Edit Novel')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/user/edit_novel.css') }}">
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
@section('containerClassName', 'editNovelContainer')
@section('content')

    @if (session('successMsg'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: `{!! nl2br(e(session('successMsg'))) !!}`,
                    showConfirmButton: false,
                    timer: 5000
                });
            });
        </script>
    @endif

    <div class="container">
        <form action="{{ route('novel.edit_insert', ['novelID' => $novelID]) }}" method="post" id="form" enctype="multipart/form-data" class="form-group">
            @csrf
            <div class="d-flex flex-column">
                <h2>แก้ไข {{$data->novel_name}}</h2>
                <div>
                    <label for="" class="form-label">ชื่อเรื่อง</label>
                    <input type="text" name="title" class="form-control" required value="{{$data->novel_name}}">
                </div>
                <div>
                    <label for="" class="form-label mt-3">แนะนำเรื่อง</label>
                    <textarea name="recommend" class="form-control" id="" cols="100" rows="8">{{$data->novel_description}}</textarea>
                </div>
                <div>
                    <label for="" class="form-label mt-3">ตั้งค่าสถานะเรื่อง</label>
                    <select name="status" id="" class="form-control">
                        <option value="0" {{$data->novel_status == 0 ? 'selected' : ''}}>เฉพาะฉัน</option>
                        <option value="1" {{$data->novel_status == 1 ? 'selected' : ''}}>สาธารณะ</option>
                    </select>
                </div>
                <div>
                    <label for="" class="form-label mt-3">เลือกหมวดหมู่</label>
                    <select name="type" id="" class="form-control">
                        @foreach ($novel_types as $type)
                            <option value="{{$type->novelTypeID}}" {{$data->novelTypeID == $type->novelTypeID ? "selected" : ''}}>{{$type->novelType_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex mt-4">
                    <input type="submit" value="อัปเดตนิยาย" class="btn btn-primary">
                </div>
            </div>

            <div class="d-flex flex-column mt-3">
                <label for="inputImage" id="input-image-label" style="background-image:url({{asset($data->novel_pic)}})"></label>
                <input type="file" name="inputImage" id="inputImage" accept="image/*">
                <div class="d-flex flex-row align-item-center justify-content-center mt-2">
                    <img id="profile-image" src="{{session('user')->profile}}" alt="">
                    <label id="profile-name" for="">{{session('user')->name}}</label>
                </div>
            </div>

        </form>

        <div class="d-flex flex-column ms-4" style="margin-top: 50px">
            <h4>ตอนทั้งหมด {{$count_chapter}}</h4>
            <div class="d-flex">
                <div class="d-flex">
                    <input type="checkbox" name="chap" id="chap" class="chap">
                    <select name="chapter" class="chap ms-3">
                        <option value="0">จัดการตอน</option>
                    </select>
                    <select name="srt" id="srt" class="srt ms-3">
                        <option value="0">เรียงลำดับตอน</option>
                        <option value="1">ตอนล่าสุด</option>
                        <option value="2">ตอนแรก</option>
                    </select>
                </div>
                <div class="d-flex">
                    <button type="button" class="div37 text-white ms-3" onclick="window.location.href = '/add_chapter/{{ $novelID }}'">เพิ่มตอนใหม่</button>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="row recommend justify-content-between mt-2" id="chapter">
            <hr>
        </div> --}}
        {{-- <div class="row recommend justify-content-between">
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
                    <strong><a href="/edit_chapter/{{ $novelID }}/{{ $chapter->chapterID }}"
                            id="edit-chapter-href">{{ $chapter->chapter_name }}</a></strong>
                </div>
                <div class="col-4 text-end">
                    <div class="header-left d-flex align-items-center" style="margin-top: 12px;">
                        <i class="bi bi-eye"></i>
                        <form
                            action="{{ route('novel.chapter_status_update', ['novelID' => $novelID, 'chapterID' => $chapter->chapterID]) }}"
                            id="chapter-form" method="POST">
                            @csrf
                            <select name="status_chapter" id="pub-chapter">
                                <option value="0">เฉพาะฉัน</option>
                                @if ($chapter->chapter_status == 1)
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
        </div> --}}
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/user/edit_novel.js') }}"></script>
@endpush
