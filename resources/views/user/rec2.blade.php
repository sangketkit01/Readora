@extends('user.layout')
@section('title', 'Home')
@push('style')
    <link rel="stylesheet" href="/css/user/reccomic.css">
@endpush
@section('containerClassName', "indexContainer")

@section('content')
<div class="row">
    <div class="side">
        <p class="_1">1</p>
    </div>
    <div class="container">
        <h1>ยอดนิยม</h1>
        <a class="btn" id="btn2" href="{{ route('index.rec1') }}" target="_self" role="button">novel</a>
        <a class="btn" id="btn1" href="#" target="_self" role="button">commic</a>
        <div class="recommend-section1">
            @foreach ($comics as $comic)
                <a href="{{ route('novel.incrementAndRedirectcomic', ['bookID' => $comic->bookID]) }}" class="recommend-card-link">
                    <div class="recommend-card">
                        <img src="{{ asset($comic->book_pic) }}" alt="Novel Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $comic->book_name }}</h5>
                            <p class="card-text description">{{ $comic->book_description }}</p>
                            <p class="card-text"><small class="text-body-secondary">{{ $comic->User->name }}</small></p>
                            <p class="card-text"><small class="text-body-secondary">ยอดชม:
                                    {{ $comic->click_count }}</small></p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    <div class="side">

    </div>
    @endsection