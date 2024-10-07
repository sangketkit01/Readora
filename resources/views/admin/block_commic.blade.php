@extends('admin.home')

@section('title', 'Blocked Comics')

@push('style')
    <link rel="stylesheet" href="/css/admin/block_comic.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
@endpush

@section('content')

    <form action="{{ route('admin.get_info_search') }}" method="GET" class="search-form">
        <input type="text" name="query" placeholder="ค้นหา..." class="search-input" value="{{ request('query') }}">
        <button type="submit" class="search-button">
            <img src="/nav/search.svg" width="20" height="20" alt="search icon">
        </button>
    </form>

    <br>
    <h2 class="box-result">คอมมิคที่ถูกบล็อกทั้งหมด</h2>

    @if ($books && $books->count() > 0)
        <div class="results-container">
            @foreach ($books as $book)
                <div class="result-card">
                    <img src="{{ asset($book->book_pic) ?? '/default-book-cover.png' }}" alt="{{ $book->book_name }}">
                    <div class="result-info">
                        <p>ชื่อเรื่อง: {{ $book->book_name }}</p>
                        <p>ผู้เขียน: {{ $book->User->name ?? 'ไม่พบผู้เขียน' }}</p>
                        <p>ประเภท: {{ $book->Type->bookType_name ?? 'ไม่มีข้อมูล' }}</p>
                        <p>สถานะ: {{ $book->book_status }}</p>
                        <div class="action-buttons">
                            <button type="button" class="btn btn-success" title="Unblock Book" data-toggle="modal" data-target="#confirmModal" data-bookid="{{ $book->bookID }}" data-bookname="{{ $book->book_name }}">
                                <i class="fas fa-unlock"></i> ปลดบล็อก
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>ไม่พบคอมมิคที่ถูกบล็อก</p>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <i class="fas fa-lock-open"></i>
                    <span>คุณต้องการที่จะปลดบล็อกเรื่อง <span id="bookName"></span> หรือไม่?</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <form id="unblockForm" action="" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success" title="Unblock Book">
                            <i class="fas fa-unlock"></i> ปลดบล็อก
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $('#confirmModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var bookId = button.data('bookid'); // Extract bookID from data-* attributes

            // Update the modal's content
            var modal = $(this);
            modal.find('#bookName').text(button.data('bookname'));
            // Set the action for the form using the correct route
            modal.find('#unblockForm').attr('action', '{{ route("admin.unblock_book", ":bookID") }}'.replace(':bookID', bookId));
        });
    </script>
@endpush
