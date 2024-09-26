@extends('user.layout')
@section('title', 'Home')
@push('style')
    <link rel="stylesheet" href="/css/user/rec.css">
@endpush
@section('containerClassName', "indexContainer")

@section('content')
<div class="row">
    <div class="side">
        <p class="_1">1</p>
    </div>
    <div class="container">
        <h1>ยอดนิยม</h1>
        <a class="btn" id="btn2" href="#" target="_self" role="button">novel</a>
        <a class="btn" id="btn1" href="{{ route('index.rec2') }}" target="_self" role="button">commic</a>
        <div class="recommend-section1">
            @foreach ($novels as $novel)
                <a href="{{ route('novel.incrementAndRedirect', ['bookID' => $novel->bookID]) }}" class="recommend-card-link">
                    <div class="recommend-card">
                        <img src="{{ asset($novel->book_pic) }}" alt="Novel Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $novel->book_name }}</h5>
                            <p class="card-text">{{ $novel->book_description }}</p>
                            <p class="card-text"><small class="text-body-secondary">{{ $novel->User->name }}</small></p>
                            <p class="card-text"><small class="text-body-secondary">ยอดคลิก:
                                    {{ $novel->click_count }}</small></p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

    </div>
    <div class="side">

    </div>


    @endsection