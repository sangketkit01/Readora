@extends('admin.home')

@section('title', 'Book Detail')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/admin/bookdetail.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

@endpush

@section('content')
    <div class="container">

        <button onclick="window.history.back();" class="back-button">
            <i class="fas fa-arrow-left"></i> <!-- ตัวอย่างไอคอนจาก Font Awesome -->
        </button>
        
        @if (session('success'))
            <div class="alert alert-success" id="successAlert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" id="errorAlert">
                {{ session('error') }}
            </div>
        @endif
        @foreach ($books as $book)
            <div class="book-detail">
                <div class="book-cover">
                    <img src="{{ asset($book->book_pic) }}" alt="Book Cover">
                </div>
                <div class="book-info">
                    <h1 class="book-title">ชื่อเรื่อง {{ $book->book_name }}</h1>
                    <p class="book-author">ผู้เขียน {{ optional($book->User)->name ?? 'Unknown Author' }}</p>
                    <p class="book-description">คำแนะนำนิยาย {{ $book->book_description }}</p>
                    <p class="book-genre">ประเภท {{ $book->Type->bookType_name ?? 'ไม่มีข้อมูล' }}</p>
                    <form action="{{ route($book->book_status == 'block' ? 'book.unblock' : 'book.block', $book->bookID) }}"
                        method='post' class="block-form">
                        @csrf
                        <button type="button" class="block"
                            onclick="confirmAction('{{ $book->book_name }}', '{{ $book->book_status }}', this.closest('form'))">
                            {{ $book->book_status == 'block' ? 'ปลดบล็อก' : 'บล็อก' }} <!-- เปลี่ยนที่นี่ -->
                        </button>
                    </form>

                </div>
            </div>
        @endforeach

        <div class="reports-section">
            <h2>ข้อความรายงานเรื่องนี้ทั้งหมด ({{ $reports->count() }})</h2>
            @if ($reports->isEmpty())
                <p class="no-reports">ยังไม่มีรายงาน</p>
            @else
                <ul class="reports-list">
                    @foreach ($reports as $report)
                        <li class="report-item">
                            <div class="report-card">
                                <p class="report-message"> {{ $report->report_message }}</p>
                                <div class="report-profile">
                                    <p class="report-username">{{ $report->name ?? 'Unknown Reporter' }}</p>
                                    <img src="{{ asset($report->profile) }}" alt="Profile Picture"
                                        class="report-profile-pic">
                                </div>
                                <p class="report-date">{{ $report->created_at->format('d/m/Y') }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <!-- Modal Popup -->
    <div id="confirmationModal" class="modal" style="display: none;"> <!-- เพิ่ม style="display: none;" -->
        <div class="modal-content">
            <span class="close" id="modalClose">&times;</span>
            <div class="modal-body">
                <h2 id="modalQuestion">
                    คุณต้องการที่จะบล็อกเรื่อง <span id="bookName"></span> หรือไม่?
                </h2>
            </div>
            <div class="modal-buttons">
                <button class="confirm-button" id="confirmBlock">ยืนยัน</button>
                <button class="cancel-button" id="cancelBlock">ยกเลิก</button>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let currentForm; // เพื่อเก็บฟอร์มที่ต้องการส่ง

            // ฟังก์ชันเปิด modal
            window.confirmAction = function(bookName, currentStatus, form) {
                var action = currentStatus === 'block' ? 'ปลดบล็อก' : 'บล็อก';
                var modalMessage = 'คุณต้องการที่จะ ' + action + ' เรื่อง ' + bookName + ' หรือไม่?';

                $('#modalQuestion').text(modalMessage); // แสดงข้อความใน modal
                $('#confirmationModal').show(); // แสดง modal เมื่อกดปุ่ม

                currentForm = form; // เก็บฟอร์มไว้เพื่อส่งในภายหลัง
            };

            // ฟังก์ชันปิด modal
            $('#modalClose, #cancelBlock').click(function() {
                $('#confirmationModal').hide(); // ซ่อน modal
            });

            // ฟังก์ชันยืนยันการดำเนินการ
            $('#confirmBlock').click(function() {
                if (currentForm) {
                    currentForm.submit(); // ส่งฟอร์มที่ถูกเก็บไว้
                }
            });
            $(window).click(function(event) {
                if (event.target.id === 'confirmationModal') {
                    $('#confirmationModal').hide(); // ซ่อน modal เมื่อคลิกที่พื้นที่นอก
                }
            });
        });
    </script>
@endpush
