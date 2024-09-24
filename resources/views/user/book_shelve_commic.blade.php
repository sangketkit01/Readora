@extends('user.layout')
@section('title', 'Home')
@push('style')
    <link rel="stylesheet" href="/css/user/rec.css">
@endpush
@section('containerClassName', 'indexContainer')

@section('content')
<div class="row">
    <div class="side"></div>
    <div class="container">
        <h1>ชั้นหนังสือของฉัน</h1>
        <a class="btn" id="btn2" href="{{ route('index.book_shelve') }}" target="_self" role="button">novel</a>
        <a class="btn" id="btn1" href="#" target="_self" role="button">commic</a>

        <div>
            <select name="" id="">
                <option value="0">เพิ่มอันแรก</option>
                <option value="1">เพิ่มล่าสุด</option>
            </select>
        </div>


        <div class="recommend-section1" id="recommendSection">
            @foreach ($comics as $comic)
                <div class="recommend-card">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{asset($comic->book_pic)}}" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$comic->book_name}}</h5>
                                <p class="card-text">{{$comic->book_description}}</p>
                                <p class="card-text"><small class="text-body-secondary">{{$comic->User->name}}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="side"></div>
</div>
    

    @endsection