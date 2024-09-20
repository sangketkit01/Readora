@extends('user.layout')
@section('title', 'Create Novel')
@push('style')
    <link rel="stylesheet" href="/css/user/create_novel.css" />
@endpush
@section('containerClassName', 'createNovelContainer')
@section('content')
    <div class="container">
        <form action="{{ route('novel.insert') }}" method="post" class="form-group d-flex align-items-center" enctype="multipart/form-data" >
            @csrf
            <div class="d-flex flex-column">
                <h2>สร้างนิยาย</h2>
                <div>
                    <label for="" class="form-label">ชื่อเรื่อง</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div>
                    <label for="" class="form-label mt-3">แนะนำเรื่อง</label>
                    <textarea name="recommend" class="form-control" id="" cols="100" rows="8"></textarea>
                </div>
                <div>
                    <label for="" class="form-label mt-3">ตั้งค่าสถานะเรื่อง</label>
                    <select name="status" id="" class="form-control">
                        <option value="0">เฉพาะฉัน</option>
                        <option value="1">สาธารณะ</option>
                    </select>
                </div>
                <div>
                    <label for="" class="form-label mt-3">เลือกหมวดหมู่</label>
                    <select name="type" id="" class="form-control">
                        @foreach ($novel_types as $type)
                            <option value="{{$type->novelTypeID}}">{{$type->novelType_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex mt-4">
                    <input type="submit" value="สร้างนิยาย" class="btn btn-primary">
                </div>
            </div>

            <div class="d-flex flex-column mt-3">
                <label for="inputImage" id="input-image-label"></label>
                <input type="file" name="inputImage" id="inputImage" accept="image/*" required>
                <div class="d-flex flex-row align-item-center justify-content-center mt-2">
                    <img id="profile-image" src="{{session('user')->profile}}" alt="">
                    <label id="profile-name" for="">{{session('user')->name}}</label>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/user/create_novel.js') }}"></script>
@endpush
