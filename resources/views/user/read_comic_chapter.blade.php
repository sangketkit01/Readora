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
            <form action="/commentcomic/{{ $books->bookID }}/{{ $chapters->chapterID }}" method="post">
                @csrf
                <textarea name="comment_message" rows="5" placeholder="แสดงความคิดเห็นที่นี่....." required></textarea>
                <button type="submit">ส่งความคิดเห็น</button>
            </form>
        </div>
        <div class="com">
            <h4>ความคิดเห็นทั้งหมด ({{ $commentCount }})</h4>
            @foreach ($chapterComments as $comment)
                <div class="comment-item">
                    <div class="header_com">
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

    </div>
Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque ex sit soluta illum laudantium, incidunt at ipsa odio laboriosam optio eveniet vel fuga dolore dicta nostrum exercitationem dolor beatae tenetur.
Fuga mollitia laborum doloremque fugit nihil facere nobis illum sint quasi dolorem rerum sapiente aperiam dolor, magnam porro cupiditate hic perspiciatis sequi amet. Qui accusamus velit, tempore excepturi obcaecati error!
Aliquid consectetur culpa voluptate mollitia quas voluptatem, dicta aut ipsam natus tenetur quo beatae cum eaque soluta laboriosam excepturi pariatur recusandae vero veniam. Iure eius dolor temporibus expedita, nam a!
Voluptates beatae natus sunt quae asperiores. Quas officiis ut ipsa dolore, aliquid inventore nostrum veniam ad dolores exercitationem! Animi nulla, sunt blanditiis quidem quam porro? A voluptatibus quae maxime exercitationem.
Aperiam neque ullam sint consequuntur provident repellat! Commodi sint molestias modi culpa unde adipisci ipsam perferendis aspernatur quaerat id qui voluptate veniam, blanditiis dicta ratione odit pariatur consequatur ut! Dolores.
Provident nulla magnam ratione deleniti veritatis, dolorem aliquam, at mollitia, optio quam id reiciendis dolores modi harum cum fuga ex eligendi excepturi. Veniam non atque maxime nisi nostrum vel animi?
Amet delectus quo deserunt tempora. Iure amet placeat optio consequuntur est recusandae repellendus maxime ullam dignissimos itaque minima voluptatem blanditiis, asperiores provident eveniet. Architecto quasi inventore asperiores quia esse voluptatibus!
A sint nulla laboriosam ratione nam eum, tempore alias explicabo rerum ex eveniet atque totam porro possimus architecto ipsam ullam et earum nostrum aperiam? Vitae hic nemo fugit molestias vero.
Perferendis illo incidunt doloremque tempora expedita labore, ut beatae dolore aperiam necessitatibus rerum impedit dignissimos rem, ex quaerat, quo soluta. Sunt aliquam velit culpa cupiditate repudiandae rem quas aliquid hic.
Sapiente necessitatibus nihil quisquam tempore autem sit. Tempora debitis optio veritatis possimus corrupti ea a odio eveniet magni, porro explicabo quo facere libero repellat sequi doloremque non velit expedita quos.
Doloribus at natus voluptates maiores, maxime minima consequuntur incidunt blanditiis rem quidem. Quidem placeat dignissimos eum tenetur dicta blanditiis atque dolore labore itaque, laborum maxime culpa animi temporibus veritatis! Blanditiis.
Itaque tempore quia enim eos unde asperiores perspiciatis maiores ratione, vero sequi nihil est, pariatur ipsa neque eaque. Eius nemo architecto quos repudiandae culpa! Doloremque, unde nisi. Pariatur, nisi fuga.
Optio odit aut quo molestiae tenetur placeat ipsa illum dicta accusantium, velit alias ab saepe ea ducimus adipisci debitis culpa ratione. Nam ut totam optio sint officia, voluptates quia atque?
Vero voluptate rem adipisci totam, eius aliquid eum. Obcaecati, non recusandae tempora, ex expedita soluta alias ipsa totam sequi ut iste repellendus! Maiores, reiciendis nemo voluptas ipsam corporis quidem ullam.
Nostrum sunt accusamus veniam optio fugit dolore doloribus laborum sint voluptatum sapiente aperiam ab iste hic, molestiae itaque commodi accusantium provident nulla dolores, exercitationem maiores. Nulla expedita quaerat eos tempora?
Quod, deleniti! Nam ducimus soluta est, consequuntur laboriosam quis ipsa repellat, quas eaque eligendi voluptatum voluptas, ullam eum molestiae provident officiis animi quo consectetur eos. Deleniti iste maxime debitis dolores!
Itaque, aut corporis, animi ad illum nulla mollitia tempora suscipit facilis dolorum nihil rem asperiores ipsa aliquam labore iure ex repellendus eaque odio officiis blanditiis pariatur maxime doloremque? Aperiam, culpa?
Minima maiores quae nobis voluptas, nostrum vero incidunt architecto molestias aperiam aliquam doloremque amet beatae harum quia repudiandae sit ratione inventore odio necessitatibus temporibus maxime. Deserunt mollitia voluptatibus recusandae reprehenderit!
Laborum cum, recusandae in suscipit culpa veniam hic fuga qui natus tenetur ducimus quaerat aut eligendi perferendis libero consectetur officiis atque exercitationem. Natus cupiditate qui laboriosam eaque nulla voluptates tempore.
Ab dignissimos doloribus id quasi debitis! Deleniti debitis eius commodi iure minus enim sapiente odio maiores sint, cum, ratione error vel iste! Esse iusto quidem accusamus corporis beatae, ea ad!
@endsection
