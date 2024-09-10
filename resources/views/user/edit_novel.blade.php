@extends("user.layout")
@section("title","Edit Novel")
@push("style")
    <link rel="stylesheet" href="{{asset('css/user/edit_novel.css')}}">
@endpush
@section("containerClassName","editNovelContainer")
@section("content")
    
@endsection

@push("scripts")
    <script src="{{asset('js/user/edit_novel.js')}}"></script>
@endpush