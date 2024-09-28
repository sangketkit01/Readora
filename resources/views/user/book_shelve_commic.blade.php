@extends('user.layout')
@section('title', 'Home')
@push('style')
    <link rel="stylesheet" href="/css/user/search-result.css">
    <link rel="stylesheet" href="/css/user/shelvecomic.css">
@endpush
@section('containerClassName', )

@section('content')
<div class="row">
    <div class="side"></div>
    <div class="container">
        <h1>ชั้นหนังสือของฉัน</h1>
        <a class="btn" id="btn2" href="{{ route('index.book_shelve') }}" target="_self" role="button">novel</a>
        <a class="btn" id="btn1" href="#" target="_self" role="button">commic</a>


        <div class="recommend-section1" id="recommendSection">
            @foreach ($comics as $comic)
                <a href="{{ route('read.read_comic', ['bookID' => $comic->book->bookID]) }}" class="recommend-card-link">
                    <div class="recommend-card">
                        <img src="{{ asset($comic->book->book_pic) }}" alt="Novel Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $comic->book->book_name }}</h5>
                            <p class="card-text">{{ $comic->book->book_description }}</p>
                            <p class="card-text"><small class="text-body-secondary">{{ $comic->User->name }}</small></p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    <div class="side"></div>
</div>


@endsection

@push('scripts')
    <script src="{{ asset('js/user/new_page.js') }}"></script>
@endpush