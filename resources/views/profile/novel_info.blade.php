@extends('user.layout')
@section('title', 'Your novels')
@push('style')
    <link rel="stylesheet" href="/css/profile/profile.css">
@endpush
@section('containerClassName', 'NovelInfoContainer')

@section('content')
    <div class="row mt-3">
        <div class="top">
            <img src="{{ asset($user->profile) }}" alt="" onclick="" style="object-fit: cover">
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

    @if ($all_novel == 0)
        <div class="row mt-3 ">
            <div class="dropdown-option if">
                <a class="btn btn-black dropdown-toggle fs-4 fw-semibold" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    นิยายของฉัน
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('profile') }}">ข้อมูลส่วนตัว</a></li>
                    <li><a class="dropdown-item" href="{{ route('bookshelf') }}">ชั้นหนังสือของฉัน</a></li>
                    <li><a class="dropdown-item" href="{{ route('profile.comic') }}">คอมมิคของฉัน</a></li>
                </ul>
                <div class="btinfo">
                    <a class="deltitle" href="{{route("user.bin",["bookTypeID"=>1])}}"><i class="bi bi-trash3-fill"></i> เรื่องที่ลบไป</a>
                </div>
            </div>
        </div>

        <div class="row mt-5 n_user">
            <div class="new">
                <h3>มาสร้างนิยายเรื่องแรกกันเถอะ</h3>
                กดสร้างเรื่องใหม่เพื่อลงผลงานของคุณ <br>
                <button class="create-novel" onclick="window.location.href='/create_novel'">สร้างเรื่องใหม่</button>
            </div>
        </div>

    @else
        <div class="row mt-3 ">
            <div class="dropdown-option else">
                <a class="btn btn-black dropdown-toggle fs-4 fw-semibold" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    นิยายของฉัน
                </a>
                <ul class="dropdown-menu ">
                    <li><a class="dropdown-item" href="{{ route('profile') }}">ข้อมูลส่วนตัว</a></li>
                    <li><a class="dropdown-item" href="{{ route('bookshelf') }}">ชั้นหนังสือของฉัน</a></li>
                    <li><a class="dropdown-item" href="{{ route('profile.comic') }}">คอมมิคของฉัน</a></li>
                </ul>
                <div class="btinfo">
                    <a class="deltitle" href="{{route("user.bin",["bookTypeID"=>1])}}"><i class="bi bi-trash3-fill"></i> เรื่องที่ลบไป</a>
                    <button class="create-novel-n" onclick="window.location.href='/create_novel'">สร้างเรื่องใหม่</button>
                </div>
            </div>
        </div>

        <div class="row mt-3 card_user">
            @foreach ($novels as $c)
                <div class="col-3 mt-3 d-flex justify-content-center" onclick="window.location.href='{{ route('novel.edit', ['bookID' => $c->bookID]) }}'">
                    <div class="card" style="width: 14rem; max-width: 14rem;">
                        <img src="{{asset($c->book_pic)}}" class="card-img-top img_user" alt="...">

                        <div class="status-button">
                            @if($c->book_status == 'public')
                                <button class="rounded-pill mt-2" onclick="return false;"> <i class="fa-solid fa-earth-americas"></i> สาธารณะ</button>
                            @else
                                <button class="rounded-pill mt-2" onclick="return false;"> <i class="fa-solid fa-lock"></i></i></i> ส่วนตัว</button>
                            @endif
                        </div>

                        <div class="card-body">
                            <div class="n-info">
                                <h5>{{$c->book_name}}</h5>
                                <p id="writer">{{$c->username}}</p>
                            </div>
                            <span id="chapter"><i class="fa-solid fa-list-ul"></i> {{$c->chapters_count}}</span> 
                            <span id="comment"><i class="fa-solid fa-comment"></i> comment</span> <br>
                            <span id="genre">{{$c->Genre->bookGenre_name}}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
    @endif

@endsection
