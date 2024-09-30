@extends('user.layout')
@section('title', 'User Novel bin')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/user/bin.css') }}">
@endpush

@section('containerClassName', 'UserNovelBinContainer')
@section('content')
    @if ($books->isEmpty())
        <div class="no-bin">
            ไม่มี{{$bookTypeID == 1 ? "นิยาย" : "คอมมิค"}}ที่ถูกลบ
        </div>
    @else
        <h4 class="h4">{{$bookTypeID == 1 ? "นิยาย" : "คอมมิค"}}ทั้งหมด {{$books->count()}}</h4>
        <div class="d-flex flex-column justify-content-between bin">

            <div class="d-flex mb-3" style="width: 100%">
                <button class="btn btn-primary ms-auto me-2" type="button" onclick="RestoreAll({{$bookTypeID}})">กู้คืนทั้งหมด</button>
                <button class="btn btn-danger me-4" type="button" onclick="DeleteAll({{$bookTypeID}})">ลบฐาวรทั้งหมด</button>
            </div>
            <form action="{{route('user.restore_all',["bookTypeID"=>$bookTypeID])}}" method="POST" id="restore-all" style="display: none">@csrf</form>
            <form action="{{route('user.delete_all',["bookTypeID"=>$bookTypeID])}}" method="POST" id="delete-all" style="display: none">@csrf</form>

            @php
                $count = 0;
            @endphp

            @foreach ($books as $book)
                @php
                    $count += 1;
                @endphp
                <div class="d-flex">

                    <div class="d-flex ms-4 mt-3 align-items-center">
                        <strong>{{ $count }}</strong>
                        <img class="images ms-2" src="{{ asset($book->book_pic) }}" alt="">
                        <strong>{{ $book->book_name }}</strong>
                    </div>
                    <div class="d-flex ms-auto me-4 align-items-center">
                        <button class="btn btn-primary" type="button"
                            onclick="RestoreEach({{$book->bookID}},{{$bookTypeID}},'{{ $book->book_name }}')">กู้คืน</button>
                        <form
                            action="{{ route('user.restore_each', ['bookTypeID'=>$bookTypeID,'bookID' => $book->bookID]) }}"
                            style="display: none;" method="POST" id="restore-each-{{ $book->bookID }}">@csrf</form>

                        <button class="btn btn-danger ms-2" type="button"
                            onclick="DeleteEach({{$book->bookID}},{{$bookTypeID}},'{{ $book->book_name }}')">ลบฐาวร</button>
                        <form
                            action="{{ route('user.delete_each', ['bookTypeID'=>$bookTypeID,'bookID' => $book->bookID]) }}"
                            style="display: none;" method="POST" id="delete-each-{{ $book->bookID }}">@csrf</form>
                    </div>

                </div>
            @endforeach
        </div>
    @endif
@endsection

@push('scripts')
    <script src="{{asset('js/user/bin.js')}}"></script>
@endpush
