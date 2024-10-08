@extends('user.layout')
@section('title', 'Home')
@push('style')
    <link rel="stylesheet" href="/css/user/read.css">
@endpush
@section('containerClassName', 'indexContainer')

@section('content')
<a href="{{ route('index') }}" id="back-icon"><i class="bi bi-arrow-left-circle-fill fs-1"></i> </a>
    @foreach ($books as $book)
        <div class="container_user">
            <div class="card_user">
                <div class="img row col-4 md-6 sm-12">
                    <img src="{{ asset($book->book_pic) }}
                            " alt="">
                </div>
                <div class="user col-8 md-6 sm-12">
                    <div class="head">
                        <h1>{{ $book->book_name }}
                        </h1>
                    </div>
                    <div class="profile_user">
                        <img src="{{ asset($book->User->profile) }}
                            " alt="">
                        <p>{{ $book->User->name }}
                        </p>
                    </div>
                    <div class="type">
                        <h4>{{ $book->Genre->bookGenre_name }}</h4>
                    </div>
                    <div class="button">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="mr-2">
                                <form action="{{ route('add_to_shelf') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="bookID" value="{{ $book->bookID }}">
                                    @if ($book->User->username == session('user')->username)
                                        <a type="button" href="{{ route('comic.edit', ['bookID' => $book->bookID]) }}"
                                            class="button_1 me-2">แก้ไข</a>
                                    @elseif ($shelve)
                                        <button type="button" onclick="DeleteOutOfShelve('{{$book->book_name}}')" class="button_1 me-2">ลบออกจากชั้น</button>
                                    @else
                                        <button type="submit" class="button_1 me-2">เพิ่มเข้าชั้น</button>
                                    @endif

                                    @if (session('success_message'))
                                        <script>
                                            document.addEventListener("DOMContentLoaded",()=>{
                                                Swal.fire({
                                                    position: "center",
                                                    icon: "success",
                                                    title: `{!! nl2br(e(session('success_message'))) !!}`,
                                                    showConfirmButton: false,
                                                    timer: 5000
                                                });
                                            })
                                        </script>
                                    @endif

                                    @if (session('error_message'))
                                        <script>
                                            document.addEventListener("DOMContentLoaded",()=>{
                                                Swal.fire({
                                                    position: "center",
                                                    icon: "error",
                                                    title: `{!! nl2br(e(session('error_message'))) !!}`,
                                                    showConfirmButton: false,
                                                    timer: 5000
                                                });
                                            })
                                        </script>
                                    @endif
                                    <a href="{{ route('read.read_first_chaptcomic', ['bookID' => $book->bookID]) }}"
                                        class="btn button_2">อ่านเลย</a>
                                </form>
                                <form action="{{route('read.delete_shelve',["bookID"=>$book->bookID])}}" id="delete-shelve-form" method="post">@csrf</form>
                            </div>
                            @if ($book->User->username != session('user')->username)
                                <button type="button" class="btn report-button" onclick="openModal()">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </button>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <div class="Introducing">
                <h4>แนะนำเนื้อเรื่อง</h4>
                <p>{{ $book->book_description }}
                </p>{{-- loopข้อมูลมาวส่สะ --}}
            </div>
            <div class="All_episodes">
                <h4>ตอนทั้งหมด ( {{ $count_chapter }} )</h4>
                <select name="" id="">
                    <option value="0">ตอนทั้งหมด</option>
                    <option value="1">ตอนล่าสุด</option>
                    <option value="2">ตอนแรก</option>
                </select>
                @php
                    $count = 0;
                @endphp
                @foreach ($chapters as $chapter)
                    <div class="">
                        <hr>

                        <div class="col-8" id="sub-chap">
                            @php
                                $count += 1;
                            @endphp
                            <strong>{{ $count }}</strong>
                            <img class="images" src="{{ asset($chapter->chapter_image) }}" alt="">
                            <strong>
                                <a href="{{ route('read.read_chaptcomic', ['bookID' => $book->bookID, 'chapterID' => $chapter->chapterID]) }}"
                                    id="edit-chapter-href">
                                    {{ $chapter->chapter_name }}
                                </a>
                            </strong>
                        </div>
                    </div>
                @endforeach
                <hr>
            </div>
            <div class="share-div p-4 d-flex flex-column justify-content-center align-items-center">
                <button id="share-button" onclick="shareClicked()">Share</button>
                <div class="modal-container">
                    <div class="modal-content-share">
                        <div class="modal-header d-flex flex-column">
                            <a id="exit-modal-button" onclick="closeShare()"><img src="{{ asset('novel/exit.png') }}"
                                    width="30" alt=""></a>
                            <label for="" id="modal-label">แชร์ {{ $book->book_name }}</label>
                        </div>
                        <div class="modal-element d-flex align-items-center">
                            <input type="text" readonly id="link" class="form-control">
                            <a id="share-modal-button" onclick="copyLink()"><img src="{{ asset('novel/copy.png') }}"
                                    width="30" alt=""></a>
                        </div>
                        <div id="alert-container"
                            style="position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); z-index: 9999;">
                        </div>
                    </div>
                </div>
            </div>

            <div class="com">
                <h4>ความคิดเห็นทั้งหมด ( {{ $count_comment }} )</h4>
                @foreach ($chapters as $chapter)
                    <div class="chapter-section">
                        @foreach ($chapterComments[$chapter->chapterID] ?? [] as $comment)
                            <div class="comment-item">
                                <div class="header_com">
                                    <p class="text-end">จากตอน #{{ $comment->Chapter->chapter_name }}</p>
                                    <p>{{ $comment->comment_message }}</p>
                                </div>
                                <div class="user_com">
                                    <div class="img_com">
                                        <img src="{{ asset($comment->User->profile) }}" alt="">
                                    </div>
                                    <div class="r_com">
                                        <div class="name_com">
                                            <p>{{ $comment->User->name }}</p>
                                        </div>
                                        <p class="p_smaill">{{ $comment->created_at }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
    @endforeach
    <div id="reportModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h3>รายงานนิยายเรื่อง: {{ $book->book_name }}</h3>
            <form id="reportForm" method="POST" action="{{ route('report.submit') }}">
                @csrf
                <input type="hidden" name="bookID" value="{{ $book->bookID }}">
                <input type="hidden" name="username" value="{{ Session::get('user')->username }}">
                <textarea class="form-control" id="report_message" name="report_message" rows="4" required
                    placeholder="เขียนข้อความรายงานที่นี่....."></textarea>

                <button type="submit" class="btn btn-primary">รายงาน</button>
            </form>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="/js/user/read_report.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.getElementById("link").value = window.location.href;
        })
    </script>
@endpush
