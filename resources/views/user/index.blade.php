@extends('user.layout')
@section('title', 'Home')
@push('style')
    <link rel="stylesheet" href="/css/user/index.css">
@endpush
@section('containerClassName', "indexContainer")

@section('content')
<div id="banner" class="container">
    <input type="radio" name="slider" id="item-1" checked>
    <input type="radio" name="slider" id="item-2">
    <input type="radio" name="slider" id="item-3">
    <div class="cards">
        <label class="card" for="item-1" id="song-1">
            <img class="images"
                src="https://images.unsplash.com/photo-1530651788726-1dbf58eeef1f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=882&q=80"
                alt="song">
        </label>
        <label class="card" for="item-2" id="song-2">
            <img class="images"
                src="https://images.unsplash.com/photo-1559386484-97dfc0e15539?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1234&q=80"
                alt="song">
        </label>
        <label class="card" for="item-3" id="song-3">
            <img class="images"
                src="https://images.unsplash.com/photo-1533461502717-83546f485d24?ixlib=rb-1.2.1&auto=format&fit=crop&w=900&q=60"
                alt="song">
        </label>
    </div>
</div>


    <div class="container">
    <!-- Recommendation Section for Novels -->
    <div class="recommend" id="recommend1">
        <h2>แนะนำนิยาย</h2>
        <br>
        <div class="recommend-section1">
            @foreach ($novels as $novel)
                <div class="recommend-card">
                    <img src="{{ asset($novel->novel_pic) }}" alt="Novel Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $novel->novel_name }}</h5>
                        <p class="card-text">{{ $novel->novel_description }}</p>
                        <p class="card-text"><small class="text-body-secondary">{{ $novel->User->name }}</small></p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Recommendation Section for Comics -->
    <div class="recommend" id="recommend1">
        <h2>แนะนำคอมมิค</h2>
        <br>
        <div class="recommend-section1">
            @foreach ($novels as $novel)
                <div class="recommend-card">
                    <img src="{{ asset($novel->novel_pic) }}" alt="Novel Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $novel->novel_name }}</h5>
                        <p class="card-text">{{ $novel->novel_description }}</p>
                        <p class="card-text"><small class="text-body-secondary">{{ $novel->User->name }}</small></p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Romance Section -->
    <div class="recommend">
        <h2>รักโรแมนติก</h2>
        <br>
        <div class="recommend-section2">
            @foreach ($novels as $novel)
                <div class="recommend-card">
                    <img src="{{ asset($novel->novel_pic) }}" alt="Romance Novel Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $novel->novel_name }}</h5>
                        <p class="card-text">{{ $novel->novel_description }}</p>
                        <p class="card-text"><small class="text-body-secondary">{{ $novel->User->name }}</small></p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

            @endsection