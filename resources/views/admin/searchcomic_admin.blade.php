@extends('admin.home')

@section('title', 'ผลการค้นหา')

@push('style')

        <style>
            /* สไตล์หลัก */
            body {
                background-color: #f9f9f9;
                font-family: 'Kanit', Arial, sans-serif;
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 1200px;
                margin: 40px auto;
                padding: 20px;
            }

            /* สไตล์สำหรับฟอร์มค้นหา */
            .search-form {
                display: flex;
                align-items: center;
                border-radius: 25px;
                background-color: white;
                padding: 5px 10px;
                border: 1px solid #ccc;
                margin-bottom: 20px;
            }

            .search-input {
                border: none;
                border-radius: 25px;
                padding: 10px;
                font-size: 16px;
                outline: none;
                flex-grow: 1;
            }

            .search-button {
                background: none;
                border: none;
                cursor: pointer;
                padding: 5px;
            }

            .search-button img {
                vertical-align: middle;
            }

            .search-input::placeholder {
                color: #999;
            }

            /* สไตล์สำหรับผลการค้นหา */
            .result {
                font-size: 18px;
                margin-bottom: 20px;
                color: #333;
            }

    .recommend-section1 {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .recommend-card-link {
        text-decoration: none;
        color: inherit;
        flex-basis: calc(50% - 10px); /* สองคอลัมน์ */
        max-width: calc(50% - 10px); /* สองคอลัมน์ */
    }

            .recommend-card {
                display: flex;
                background-color: #fff;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                overflow: hidden;
                transition: transform 0.3s ease-in-out;
            }

            .recommend-card:hover {
                transform: translateY(-5px);
            }

            .recommend-card img {
                width: 150px;
                height: 200px;
                object-fit: cover;
            }

            .card-body {
                padding: 15px;
                flex-grow: 1;
            }

            .card-title {
                font-size: 18px;
                margin: 0 0 10px 0;
                color: #333;
            }

            .card-text {
                font-size: 14px;
                color: #666;
                margin-bottom: 5px;
            }

            /* สไตล์สำหรับการแบ่งหน้า */
            .pagination {
                display: flex;
                justify-content: center;
                list-style: none;
                padding: 0;
                margin-top: 20px;
            }

            .pagination li {
                margin: 0 5px;
            }

            .pagination li a,
            .pagination li span {
                display: block;
                padding: 8px 12px;
                background-color: #fff;
                border: 1px solid #ddd;
                color: #333;
                text-decoration: none;
                border-radius: 4px;
            }

            .pagination li.active span {
                background-color: #007bff;
                color: #fff;
                border-color: #007bff;
            }

            /* สไตล์สำหรับหน้าจอขนาดเล็ก */
            @media (max-width: 768px) {
                .recommend-card-link {
                    flex-basis: 100%;
                    max-width: 100%;
                }

                .recommend-card {
                    flex-direction: column;
                }

                .recommend-card img {
                    width: 100%;
                    height: 200px;
                }
            }
        </style>
@endpush

@section('content')
<div class="container">
    <div class="row">
        <form action="{{ route('admin.search_admincomic') }}" method="GET" class="search-form">
            <input type="text" name="query" placeholder="ค้นหา..." class="search-input" value="{{ $query }}">
            <button type="submit" class="search-button">
                <img src="{{ asset('nav/search.svg') }}" width="20" height="20" alt="ค้นหา">
            </button>
        </form>
        <div>
            <p class="result">ผลการค้นหาสำหรับ: "{{ htmlspecialchars($query) }}"</p>
        </div>
        @if ($books->isEmpty())
            <p>ไม่พบหนังสือตามที่ค้นหา</p>
        @else
            <div class="recommend-section1">

                @foreach ($books as $comic)
                    <a href="{{  route('admin.book_detail', ['bookID' => $comic->bookID]) }}" class="recommend-card-link">
                        <div class="recommend-card">
                            <img src="{{ asset($comic->book_pic) }}" alt="{{ htmlspecialchars($comic->book_name) }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ htmlspecialchars($comic->book_name) }}</h5>
                                <p class="card-text">{{ Str::limit(htmlspecialchars($comic->book_description), 100) }}</p>
                                <p class="card-text"><small
                                class="text-body-secondary">{{ htmlspecialchars($comic->User->name) }}</small></p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            {{ $books->links() }}
        @endif
    </div>
</div>
@endsection