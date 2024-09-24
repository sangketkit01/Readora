@extends('user.layout')
@section('title', 'Your comics')
@push('style')
    <link rel="stylesheet" href="/css/profile/profile.css">
@endpush
@section('containerClassName', 'ComicInfoContainer')

@section('content')

    <div class="row mt-3">
        <div class="top">
            <img src="{{ $user->profile }}" alt="" onclick="">
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

    @if ($c_count == 0)
        <div class="row mt-3">
            <div class="dropdown-option">
                <a class="btn btn-black dropdown-toggle fs-4 fw-semibold" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    คอมมิค
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('profile') }}">ข้อมูลส่วนตัว</a></li>
                    <li><a class="dropdown-item" href="{{ route('profile.novel') }}">นิยาย</a></li>
                </ul>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="new">
                <h3>มาสร้างคอมมิคเรื่องแรกกันเถอะ</h3>
                กดสร้างเรื่องใหม่เพื่อลงผลงานของคุณ <br>
                <button class="create-comic" onclick="window.location.href='/'">สร้างเรื่องใหม่</button>
            </div>
        </div>

    @else
        <div class="row mt-3">
            <div class="dropdown-option">
                <a class="btn btn-black dropdown-toggle fs-4 fw-semibold" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    คอมมิค
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('profile') }}">ข้อมูลส่วนตัว</a></li>
                    <li><a class="dropdown-item" href="{{ route('profile.novel') }}">นิยาย</a></li>
                </ul>
                <button class="create-comic-n" onclick="window.location.href=''">สร้างเรื่องใหม่</button>
            </div>
        </div>

        <div class="row mt-3">
            @foreach ($comic as $item)
                <div class="col-4 mt-3">
                    <div class="c-info">

                    </div>
                </div>
            @endforeach
        </div>

    @endif

@endsection
