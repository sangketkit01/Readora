@extends('user.layout')
@section('title', 'Create Novel')
@push('style')
    <link rel="stylesheet" href="/css/user/create_novel.css" />
@endpush
@section('containerClassName', 'createNovelContainer')
@section('content')
<div class="container">
    <form action="{{ route('comic.insert') }}" method="post" class="form-group d-flex align-items-center" enctype="multipart/form-data" id="form">
        @csrf
        <div class="d-flex flex-column">
                <a href="{{ route('profile.comic') }}" id="back-icon"><i class="bi bi-arrow-left-circle-fill fs-1"></i> </a>
                <h2>สร้างคอมมิค</h2>
                <div>
                    <label for="" class="form-label">ชื่อเรื่อง</label>
                    <input type="text" name="book_name" class="form-control" required>
                </div>
                <div>
                    <label for="" class="form-label mt-3">แนะนำเรื่อง</label>
                    <textarea name="book_description" class="form-control" id="" cols="100" rows="20" required></textarea>
                </div>
                <div>
                    <label for="" class="form-label mt-3">ตั้งค่าสถานะเรื่อง</label>
                    <select name="status" id="" class="form-control">
                        <option value="public">สาธารณะ</option>
                        <option value="private">เฉพาะฉัน</option>
                    </select>
                </div>
                <div>
                    <label for="" class="form-label mt-3">เลือกหมวดหมู่</label>
                    <select name="genre" id="" class="form-control">
                        @foreach ($book_genres as $genre)
                            <option value="{{$genre->bookGenreID}}">{{$genre->bookGenre_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex mt-4">
                    <input type="button" onclick="submitForm()" value="สร้างคอมมิค" class="btn btn-primary">
                </div> 
            </div>

            <div class="d-flex flex-column mt-3">
                <div class="cover-upload">
                    <label for="inputImage" id="input-image-label"></label>
                    <input type="file" name="inputImage" id="inputImage" accept="image/*" required>
                </div>
                <div class="d-flex flex-row align-item-center justify-content-center mt-2">
                    <img id="profile-image" src="{{ asset(session('user')->profile) }}" style="object-fit: cover" alt="">
                    <label id="profile-name" for="">{{session('user')->name}}</label>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/user/create_novel.js') }}"></script>
@endpush
