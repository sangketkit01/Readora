@extends('user.layout')
@section('title', 'Your bookshelve')
@push('style')
    <link rel="stylesheet" href="/css/profile/profile.css">
@endpush
@section('containerClassName', 'BookShelveContainer')

@section('content')
    <div class="row mt-3">
        <div class="top">
            <img src="{{ $user->profile }}" alt="" onclick="">
            <div class="cover-upload">
                <label for="inputImage" id="input-image-label" style="background-image:url({{ asset($user->profile) }})"></label>
                <i class="bi bi-camera-fill icon_cam" id="camera-icon" style="cursor: pointer;"></i>
                <input type="file" name="inputImage" id="inputImage" accept="image/*" style="display:none;">
            </div>    
            <p>{{ $user->name }}</p>
            <table>
                <thead>
                    <th>นิยาย</th>
                    <th>คอมมิค</th>
                    <th>ความคิดเห็น</th>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $n_count == 0 ? '-' : $n_count }}</td>
                        <td>{{ $c_count == 0 ? '-' : $c_count }}</td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row mt-3 ">
        <div class="dropdown-option else">
            <a class="btn btn-black dropdown-toggle fs-4 fw-semibold" href="#" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                ชั้นหนังสือของฉัน
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('profile') }}">ข้อมูลส่วนตัว</a></li>
                <li><a class="dropdown-item" href="{{ route('profile.novel') }}">นิยายของฉัน</a></li>
                <li><a class="dropdown-item" href="{{ route('profile.comic') }}">คอมมิคของฉัน</a></li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="side">
    
        </div>
        <div class="container">
            <h1>ชั้นหนังสือของฉัน</h1>
            <a class="btn" id="btn1" href="#" target="_self" role="button">novel</a>
            <a class="btn" id="btn2" href="{{ route('index.book_shelve_commic') }}" target="_self" role="button">commic</a>
    
            <div>
                <select name="" id="">
                    <option value="0">เพิ่มอันแรก</option>
                    <option value="1">เพิ่มล่าสุด</option>
                </select>
            </div>
    
            <div class="recommend-section1">
                @foreach ($novels as $novel)
                    <a href="{{ route('read.read_novel', ['bookID' => $novel->bookID]) }}" class="recommend-card-link">
                        <div class="recommend-card">
                            <img src="{{ asset($novel->book_pic) }}" alt="Novel Image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $novel->book_name }}</h5>
                                <p class="card-text">{{ $novel->book_description }}</p>
                                <p class="card-text"><small class="text-body-secondary">{{ $novel->User->name }}</small></p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="side">
    
        </div>


@endsection