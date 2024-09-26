@extends('user.layout')

@section('title', 'Home')
@push('style')
    <link rel="stylesheet" href="/css/user/read_chaptnovel.css">
@endpush
@section('containerClassName', 'indexContainer')

@section('content')

    <div class="container">
        <div class="Introducing">
            <h2>{{ $chapters->chapter_name }}</h2>
            <div id="output" class="d-flex justify-content-center align-items-center flex-column">
                @if ($chapters->chapter_content)
                    <!-- Load PDF.js -->
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
                    
                    <!-- JavaScript to Render PDF -->
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const pdfUrl = "{{ asset($chapters->chapter_content) }}";
                            loadPdfFromUrl(pdfUrl);
                        });
        
                        function loadPdfFromUrl(url) {
                            const output = document.getElementById("output");
                            output.innerHTML = "";
                            
                            pdfjsLib.getDocument(url).promise.then(function(pdf) {
                                for (let pageNumber = 1; pageNumber <= pdf.numPages; pageNumber++) {
                                    pdf.getPage(pageNumber).then(function(page) {
                                        const scale = 0.8;
                                        const viewport = page.getViewport({ scale: scale });
                                        const canvas = document.createElement("canvas");
                                        const context = canvas.getContext("2d");
                                        canvas.height = viewport.height;
                                        canvas.width = viewport.width;
                                        const renderContext = {
                                            canvasContext: context,
                                            viewport: viewport,
                                        };
                                        page.render(renderContext).promise.then(function() {
                                            const img = document.createElement("img");
                                            img.src = canvas.toDataURL("image/png");
                                            img.style.margin = "10px";
                                            output.appendChild(img);
                                        });
                                    });
                                }
                            });
                        }
                    </script>
                @endif
            </div>
            <div class="writer-message">
                <strong>Writer:</strong> {{ $chapters->writer_message ?? 'No message from the writer.' }}
            </div>
            <br><br><br><br>
            <div class="pofile_user_com">
                <img src="{{ asset($books->User->profile) }}" alt="" style="object-fit: cover">
                <p>{{ $books->User->name }}</p>
            </div><br>
            <div class="button">
                @if ($previousChapter)
                    <a href="{{ route('read.read_chaptcomic', ['bookID' => $books->bookID, 'chapterID' => $previousChapter->chapterID]) }}"
                        class="btn btn-primary">ตอนก่อนหน้า</a>
                @else
                    <button class="btn btn-primary" disabled>ตอนก่อนหน้า</button>
                @endif
    
                @if ($nextChapter)
                    <a href="{{ route('read.read_chaptcomic', ['bookID' => $books->bookID, 'chapterID' => $nextChapter->chapterID]) }}"
                        class="btn btn-primary">ตอนถัดไป</a>
                @else
                    <button class="btn btn-primary" disabled>ตอนถัดไป</button>
                @endif
            </div>
        </div>

        


        <div class="comment">
            <h4>แสดงความคิดเห็น</h4>
                <textarea name="comment_message" rows="5" placeholder="แสดงความคิดเห็นที่นี่....."></textarea>
                <button type="submit">ส่งความคิดเห็น</button>
        </div>
        <div class="com">
            <h4>ความคิดเห็นทั้งหมด ({{ $commentCount }})</h4>

            @foreach ($chapterComments as $comment)
                <div class="comment-item">
                    <strong>{{ $comment->user->name }}</strong>:
                    <p>{{ $comment->comment_message }}</p>
                </div>
            @endforeach
        </div>
    </div>

@endsection
