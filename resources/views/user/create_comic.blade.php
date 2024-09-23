@extends('user.layout')
@section('title', 'Create Novel')
@push('style')
    <link rel="stylesheet" href="/css/user/create_comic.css" />
    @section('containerClassName', 'createNovelContainer')
@section('content')
    <div class="container">
        <div class="box">
            <div class="left-box">
                <h2>เพิ่มคอมมิค</h2>
                <form action="{{ route('comic.insert') }}" method="post" id="form" enctype="multipart/form-data">
                    @csrf

                    <label id="add-titlecomic-input">เพิ่มคอมมิค</label>
                    <input type="text" name="book_name">

                    <label id="recommend-input">แนะนำเรื่อง</label>
                    <textarea name="book-description" id="" cols="30" rows="5"></textarea>

                    <label class="me-2">ตั้งค่าสถานะเรื่อง</label>
                    <select name="status" id="">
                        <option value="0">เฉพาะฉัน</option>
                        <option value="1" selected>สาธารณะ</option>
                    </select>

                    <label id="type-comic">เลือกหมวดหมู่
                    </label>
                    <select name="genre" id="genre">
                        @foreach ($book_genres as $type)
                            <option value="{{ $type->bookGenreID }}">{{ $type->bookGenre_name }}</option>
                        @endforeach
                    </select>
                    <div class="buttons">
                        <button onclick="submitForm()" type="submit" class="btn-submit">ตกลง</button>
                        <button type="button" class="btn-cancel">ยกเลิก</button>
                    </div>
            </div>
            <div class="right-box">
                <div class="file-upload">
                    <div class="image-title text-center">
                        <label for="inputImage" id="input-image-label"></label>
                        <input type="file" id="inputImage" required name="inputImage" accept="image/*">
                    </div>
                </div>
                <div class="profile">
                    <img id="profile-image" src="{{ session('user')->profile }}" alt="">
                    <p for="profile-image" id="profile-name">{{ session('user')->name }}</p>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/user/create_novel.js') }}"></script>

@endpush
