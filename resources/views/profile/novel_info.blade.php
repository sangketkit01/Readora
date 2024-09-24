@extends('user.layout')
@section('title', 'Your novels')
@push('style')
    <link rel="stylesheet" href="/css/profile/profile.css">
@endpush
@section('containerClassName', 'NovelInfoContainer')

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

    @if ($n_count == 0)
        <div class="row mt-3">
            <div class="dropdown-option">
                <a class="btn btn-black dropdown-toggle fs-4 fw-semibold" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    นิยาย
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('profile') }}">ข้อมูลส่วนตัว</a></li>
                    <li><a class="dropdown-item" href="{{ route('profile.comic') }}">คอมมิค</a></li>
                </ul>
            </div>
        </div>

        <div class="row mt-5">
            <div class="new">
                <h3>มาสร้างนิยายเรื่องแรกกันเถอะ</h3>
                กดสร้างเรื่องใหม่เพื่อลงผลงานของคุณ <br>
                <button class="create-novel" onclick="window.location.href='/'">สร้างเรื่องใหม่</button>
            </div>
        </div>
    @else
        <div class="row mt-3">
            <div class="dropdown-option">
                <a class="btn btn-black dropdown-toggle fs-4 fw-semibold" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    นิยาย
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('profile') }}">ข้อมูลส่วนตัว</a></li>
                    <li><a class="dropdown-item" href="{{ route('profile.comic') }}">คอมมิค</a></li>
                </ul>
                <button class="create-novel-n" onclick="window.location.href=''">สร้างเรื่องใหม่</button>
            </div>

        </div>

        <div class="row mt-3">
            <div class="col-3">
                @foreach ($novel as $n)
                    <img src="{{$n->book_pic}}" alt="">
                    {{$n->book_name}} <br>
                    {{$n->username}} <br>
                    <span></span> 
                    {{$n->Genre->bookGenre_name}}
                @endforeach
            </div>

        </div>
    @endif


    {{-- $table->increments("bookID");
            $table->string("username");
            $table->unsignedInteger("bookTypeID");
            $table->unsignedInteger("bookGenreID");
            $table->string("book_name");
            $table->string("book_pic");
            $table->text("book_description");
            $table->string("book_status",7)->default("public");
            $table->timestamps();
            $table->softDeletes(); --}}

@endsection
