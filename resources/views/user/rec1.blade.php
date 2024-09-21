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
        <a class="btn" id="btn1" href="#" target="_self" role="button">novel</a>
        <a class="btn" id="btn2" href="{{ route('index.rec2') }}" target="_self" role="button">commic</a>
        <div class="recommend-section1">
            @foreach ($novel as $novel)
            <div class="recommend-card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{asset($novel->novel_pic)}}" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{$novel->novel_name}}</h5>
                            <p class="card-text">{{$novel->novel_description}}</p>
                            <p class="card-text"><small class="text-body-secondary">{{$novel->User->name}}</small></p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="side">

    </div>
@endsection