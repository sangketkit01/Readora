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
            <div class="dropdown-option if">
                <a class="btn btn-black dropdown-toggle fs-4 fw-semibold" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    คอมมิค
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('profile') }}">ข้อมูลส่วนตัว</a></li>
                    <li><a class="dropdown-item" href="{{ route('bookshelf') }}">ชั้นหนังสือของฉัน</a></li>
                    <li><a class="dropdown-item" href="{{ route('profile.novel') }}">นิยาย</a></li>
                </ul>
                <div class="btinfo">
                    <a class="deltitle" href="{{route("user.bin",["bookTypeID"=>2])}}"><i class="bi bi-trash3-fill"></i> เรื่องที่ลบไป</a>
                </div>
            </div>
        </div>
        
        <div class="row mt-5 n_user">
            <div class="new">
                <h3>มาสร้างคอมมิคเรื่องแรกกันเถอะ</h3>
                กดสร้างเรื่องใหม่เพื่อลงผลงานของคุณ <br>
                <button class="create-comic" onclick="window.location.href='/create_comic'">สร้างเรื่องใหม่</button>
            </div>
        </div>

    @else
        <div class="row mt-3">
            <div class="dropdown-option else">
                <a class="btn btn-black dropdown-toggle fs-4 fw-semibold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    คอมมิคของฉัน
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('profile') }}">ข้อมูลส่วนตัว</a></li>
                    <li><a class="dropdown-item" href="{{ route('bookshelf') }}">ชั้นหนังสือของฉัน</a></li>
                    <li><a class="dropdown-item" href="{{ route('profile.novel') }}">นิยายของฉัน</a></li>
                </ul>
                <div class="btinfo">
                    <button class="deltitle"><i class="bi bi-trash3-fill"></i> เรื่องที่ลบไป</button>
                    <button class="create-novel-n" onclick="window.location.href='/create_novel'">สร้างเรื่องใหม่</button>
                </div>
            </div>
        </div>

        <div class="row mt-3 card_user">
            @foreach ($comic as $c)
                <div class="col-3 mt-3 d-flex justify-content-center" onclick="window.location.href='{{ route('comic.edit', ['bookID' => $c->bookID]) }}'">
                    <div class="card" style="width: 14rem; max-width: 14rem;">
                        <img src="{{asset($c->book_pic)}}" class="card-img-top img_user" alt="...">

                        <div class="status-button">
                            @if($c->book_status == 'public')
                                <button class="rounded-pill mt-2  " disabled > <i class="bi bi-globe-americas"></i> สาธารณะ</button>
                            @else
                                <button disabled> <i class="bi bi-lock-fill"></i></i> ส่วนตัว</button>
                            @endif
                        </div>

                        <div class="card-body">
                            <div class="her">
                                <h5>{{$c->book_name}}</h5>
                                <p id="writer">{{$c->username}}</p>
                            </div>
                            <span id="chapter"><i class="fa-solid fa-list-ul"></i>{{$c->n_chapter}} chapter </span> <span><i class="fa-solid fa-comment"></i> comment</span> <br>
                            <span id="genre">ประเภท {{$c->Genre->bookGenre_name}}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


    @endif

@endsection
