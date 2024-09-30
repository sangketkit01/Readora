@extends('admin.home')

@section('title', 'Check Report')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/admin/checkreport_admin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endpush

@section('content')
    <div class="tabs">
        <div class="tab active" id="all" onclick="filterReports('all')">ทั้งหมด</div>
        <div class="tab" id="novel" onclick="filterReports('1')">นิยาย</div>
        <div class="tab" id="comic" onclick="filterReports('2')">คอมมิค</div>        
    </div>

    @if ($reports->isEmpty())
        <p class="warning">ไม่พบข้อมูลรายงาน</p>
    @else
        <h2 class="box-result">รายงานทั้งหมด</h2>
        <div class="results-container">
            @foreach ($reports as $report)
                <div class="result-card" data-type="{{ $report->book->bookTypeId }}"> <!-- ใช้ bookTypeId -->
                    <img src="{{ asset($report->book->book_pic) }}" alt="{{ $report->book->book_name }}">
                    <div class="result-info">
                        <h3>{{ $report->book->book_name }}</h3>
                        <p>ผู้เขียน: {{ $report->book->user->name ?? 'ไม่มีข้อมูล' }}</p>
                        <p>ประเภท: {{ $report->book->Type->bookType_name ?? 'ไม่มีข้อมูล' }}</p>
                        <p>ผู้รีพอร์ต: {{ $report->username ?? 'ไม่มีข้อมูล' }}</p>
                        <p>ข้อความรีพอร์ต: {{ $report->report_message }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection

@push('scripts')
    <script src="{{ asset('js/user/checkreport.js') }}"></script>
@endpush
