@extends('user.layout')
@section('title', 'Your bookshelf')
@push('style')
    <link rel="stylesheet" href="/css/profile/profile.css">
@endpush
@section('containerClassName', 'BookShelveContainer')

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
                        <td>{{$totalComments == 0 ? '-' : $totalComments}}</td>
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
                <li><a class="dropdown-item" href="{{ route('profile') }}"> ข้อมูลส่วนตัว</a></li>
                <li><a class="dropdown-item" href="{{ route('profile.novel') }}">นิยายของฉัน</a></li>
                <li><a class="dropdown-item" href="{{ route('profile.comic') }}">คอมมิคของฉัน</a></li>
            </ul>
        </div>
    </div>

    <div class="row mt-3">
        
    </div>


@endsection