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

    @if ($n_count == 0)
        <div class="row mt-3 ">
            <div class="dropdown-option if">
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
                    นิยาย
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('profile') }}">ข้อมูลส่วนตัว</a></li>
                    <li><a class="dropdown-item" href="{{ route('profile.comic') }}">คอมมิค</a></li>
                </ul>
                <button class="create-novel-n" onclick="window.location.href='/create_novel'">สร้างเรื่องใหม่</button>
            </div>
        </div>

        <div class="row mt-3 card_user">
            @foreach ($novel as $n)
            <div class="col-3 mt-3 d-flex justify-content-center" onclick="window.location.href='{{ route('novel.edit', ['bookID' => $n->bookID]) }}'">
                    <div class="card" style="width: 14rem; max-width: 14rem;">
                        <img src="{{asset($n->book_pic)}}" class="card-img-top img_user" alt="...">
                        <select name="" id="">
                            <option value="public" @if($n->book_status == 'public') selected @endif>สาธารณะ</option>
                            <option value="private" @if($n->book_status == 'private') selected @endif>ส่วนตัว</option>
                        </select>
                        <div class="card-body">
                            <span>{{$n->book_name}}</span> <br> 
                            <span id="writer">{{$n->username}}</span> <br>
                            <span id="chapter"><i class="bi bi-list-ul"></i>{{$n->n_chapter}} </span>  <br>
                            <span id="genre">{{$n->Genre->bookGenre_name}}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endsection
