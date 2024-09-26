@extends('user.layout')
@section('title', 'Home')
@push('style')
    <link rel="stylesheet" href="/css/user/rec.css">
@endpush
@section('containerClassName', 'indexContainer')

@section('content')
<div class="row">
    <div class="side">

    </div>
    <div class="container">
        <h1>ชั้นหนังสือของฉัน</h1>
        <a class="btn" id="btn1" href="#" target="_self" role="button">novel</a>
        <a class="btn" id="btn2" href="{{ route('index.book_shelve_commic') }}" target="_self" role="button">commic</a>

        <div>
            <select name="" id="">
                <option value="0">เพิ่มอันแรก</option>
                <option value="1">เพิ่มล่าสุด</option>
            </select>
        </div>



        <div class="recommend-section1">
            @foreach ($novels as $novel)
                <a href="{{ route('read.read_novel', ['bookID' => $novel->bookID]) }}" class="recommend-card-link">
                    <div class="recommend-card">
                        <img src="{{ asset($novel->book_pic) }}" alt="Novel Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $novel->book_name }}</h5>
                            <p class="card-text">{{ $novel->book_description }}</p>
                            <p class="card-text"><small class="text-body-secondary">{{ $novel->User->name }}</small></p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    <div class="side">

    </div>

    @endsection