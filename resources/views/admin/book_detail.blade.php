@extends('admin.home')

@section('title', 'Book Detail')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/admin/bookdetail.css') }}">
@endpush

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
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
                    <p class="book-author">ผู้เขียน {{ $book->User->name }}</p>
                    <p class="book-description">คำแนะนำนิยาย {{ $book->book_description }}</p>
                    <p class="book-genre">ประเภท {{ $book->Type->bookType_name ?? 'ไม่มีข้อมูล' }}</p>
                    <form action="{{ route($book->book_status == 'block' ? 'book.unblock' : 'book.block', $book->bookID) }}"
                        method='post'>
                        @csrf
                        <button type="submit" class="block"
                            onclick="return confirm('Are you sure you want to {{ $book->book_status == 'block' ? 'unblock' : 'block' }} this book?')">
                            {{ $book->book_status == 'block' ? 'Unblock' : 'Block' }}
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
                                <img src="{{ asset($report->profile) }}" alt="Book Cover">
                                <p class="report-username">ชื่อผู้รายงาน: {{ $report->name }}</p>
                                <p class="report-message">ข้อความรายงาน : {{ $report->report_message }}</p>
                                <p class="report-date">{{ $report->created_at->format('d/m/Y') }}</p>
                            </li>
                        @endforeach
                </ul>
            @endif
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
                    $('.block-btn').on('click', function() {
                        var button = $(this);
                        var bookId = button.data('book-id'); // รับ book ID จาก data attribute

                        $.ajax({
                            url: '/books/' + bookId + '/toggle-status', // ใช้ bookID ใน URL
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}', // ส่ง CSRF token
                            },
                            success: function(response) {
                                console.log(response); // แสดงการตอบสนองจากเซิร์ฟเวอร์
                                button.text(response.status === 'blocked' ? 'Unblock' :
                                    'Block'); // เปลี่ยนข้อความบนปุ่ม
                                alert('Status changed to: ' + response.status); // แสดงการตอบสนอง
                            },
                            error: function(xhr) {
                                console.error(xhr.responseText); // แสดงข้อผิดพลาด
                                if (xhr.responseJSON && xhr.responseJSON.error) {
                                    alert('Error: ' + xhr.responseJSON
                                        .error); // แสดงข้อผิดพลาดที่เกิดขึ้นใน Controller
                                } else {
                                    alert('Something went wrong!'); // แสดงข้อความผิดพลาดทั่วไป
                                }
                            }
                        });
                    });
    </script>
@endpush
