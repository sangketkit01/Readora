@extends('user.layout')
@section('title', 'Home')
@push('style')
    <link rel="stylesheet" href="/css/user/index.css">
@endpush
@section('containerClassName', 'indexContainer')

@section('content')
    <div class="container">
        <div class="recommend" id="gen">
            <h2 class="section-title">หมวดหมู่</h2>
            <div class="category-tags">
                @foreach ($genres as $genre)
                    <a href="{{ route('genre.newpage', ['genreID' => $genre->bookGenreID]) }}"
                        class="category-tag">{{ $genre->bookGenre_name }}</a>
                @endforeach
            </div>
        </div>
    </div>
    <div id="banner" class="container">

        <input type="radio" name="slider" id="item-1" checked>
        <input type="radio" name="slider" id="item-2">
        <input type="radio" name="slider" id="item-3">
        <div class="cards">
            <label class="card" for="item-1" id="song-1">
                <img class="images" src="{{ asset('index/แบนเนอร์-1-1024x512.png') }}" alt="song">
            </label>
            <label class="card" for="item-2" id="song-2">
                <img class="images" src="{{ asset('index/onboarding-banner-mobile.webp') }}" alt="song">
            </label>
            <label class="card" for="item-3" id="song-3">
                <img class="images" src="{{ asset('index/20221223-notable-banner-scaled.jpg') }}" alt="song">
            </label>
        </div>
    </div>

    <div class="container">

        <!-- Recommendation Section for Novels -->
        <div class="recommend" id="recommend1">
            <h2><a href="{{ route('index.rec1') }}">แนะนำนิยาย</a></h2>
            <br>
            <div class="recommend-section1">
                @foreach ($novels as $novel)
                    <a href="{{ route('novel.incrementAndRedirect', ['bookID' => $novel->bookID]) }}"
                        class="recommend-card-link">
                        <div class="recommend-card">
                            <img src="{{ asset($novel->book_pic) }}" alt="Novel Image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $novel->book_name }}</h5>
                                <p class="card-text description">{{ $novel->book_description }}</p>
                                <p class="card-text"><small class="text-body-secondary">{{ $novel->User->name }}</small></p>
                                    @php
                                        $totalComments = $novel->Chapters->sum('comments_count');
                                    @endphp
                                <p><i class="fa-solid fa-list-ul"></i> {{$novel->Chapters->count() }} <i class="fa-solid fa-comment ms-2"></i> {{$totalComments}}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Recommendation Section for Comics -->
        <div class="recommend" id="recommend2">
            <h2><a href="{{ route('index.rec2') }}">แนะนำคอมมิค</a></h2>
            <br>
            <div class="recommend-section1">
                @foreach ($comics as $comic)
                    <a href="{{ route('novel.incrementAndRedirectcomic', ['bookID' => $comic->bookID]) }}"
                        class="recommend-card-link">
                        <div class="recommend-card">
                            <img src="{{ asset($comic->book_pic) }}" alt="Novel Image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $comic->book_name }}</h5>
                                <p class="card-text description">{{ $comic->book_description }}</p>
                                <p class="card-text"><small class="text-body-secondary">{{ $comic->User->name }}</small></p>
                                    @php
                                        $totalComments = $comic->Chapters->sum('comments_count');
                                    @endphp
                                <p><i class="fa-solid fa-list-ul"></i> {{$comic->Chapters->count() }} <i class="fa-solid fa-comment ms-2"></i> {{$totalComments}}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Romance Section -->
        <div class="recommend" id="recommend3">
            <h2>แนะนำนิยายโรแมนติก</h2>
            <br>
            <div class="recommend-section1">
                @foreach ($romanticNovels as $novel)
                    <a href="{{ route('novel.incrementAndRedirect', ['bookID' => $novel->bookID]) }}"
                        class="recommend-card-link">
                        <div class="recommend-card">
                            <img src="{{ asset($novel->book_pic) }}" alt="Novel Image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $novel->book_name }}</h5>
                                <p class="card-text description">{{ $novel->book_description }}</p>
                                <p class="card-text"><small class="text-body-secondary">{{ $novel->User->name }}</small></p>
                                    @php
                                        $totalComments = $novel->Chapters->sum('comments_count');
                                    @endphp
                                <p><i class="fa-solid fa-list-ul"></i> {{$novel->Chapters->count()}} <i class="fa-solid fa-comment ms-2"></i> {{$totalComments}}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>



@endsection

@if (session('msg'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                position: "center",
                icon: "error",
                title: '{{ session('msg') }}',
                showConfirmButton: false,
                timer: 5000
            });
        });
    </script>
@endif

@if (session('successMsg'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                position: "center",
                icon: "success",
                title: '{{ session('successMsg') }}',
                showConfirmButton: false,
                timer: 5000
            });
        });
    </script>
@endif
