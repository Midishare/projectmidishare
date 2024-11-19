@extends('layouts.layouts')

@section('content')
    <style>
        .book-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 50px;
            position: relative;
            width: 100%;
        }

        .book {
            position: relative;
            perspective: 1500px;
            width: 90%;
            max-width: 600px;
            height: 400px;
        }

        .book-page {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            display: flex;
            justify-content: center;
            align-items: center;
            transform-origin: left center;
            transition: transform 0.6s;
        }

        .book-page img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .book-page:not(:first-child) {
            transform: rotateY(-180deg);
        }

        .book-page.active {
            transform: rotateY(0);
        }

        .book-page.inactive {
            transform: rotateY(-180deg);
        }

        .book-controls {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            gap: 20px;
        }

        .btn-control {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            border: none;
            background-color: #007bff;
            color: white;
            transition: background-color 0.3s;
        }

        .btn-control:hover {
            background-color: #0056b3;
        }
    </style>

    <div class="container">
        <h1 class="text-center" style="margin-top: 100px;">{{ $book->title }}</h1>

        <div class="book-container">
            <div class="book">
                @foreach ($filePaths as $index => $path)
                    <div class="book-page {{ $index === 0 ? 'active' : 'inactive' }}" data-page="{{ $index }}">
                        <img src="{{ Storage::url($path) }}" alt="Page {{ $index + 1 }}">
                    </div>
                @endforeach
            </div>
        </div>

        <div class="book-controls">
            <button id="prevPage" class="btn-control">Sebelumnya</button>
            <button id="nextPage" class="btn-control">Berikutnya</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pages = document.querySelectorAll('.book-page');
            const prevBtn = document.getElementById('prevPage');
            const nextBtn = document.getElementById('nextPage');

            let currentPage = 0;

            function updatePages() {
                pages.forEach((page, index) => {
                    if (index === currentPage) {
                        page.classList.add('active');
                        page.classList.remove('inactive');
                    } else {
                        page.classList.remove('active');
                        page.classList.add('inactive');
                    }
                });
            }

            prevBtn.addEventListener('click', function() {
                if (currentPage > 0) {
                    currentPage--;
                    updatePages();
                }
            });

            nextBtn.addEventListener('click', function() {
                if (currentPage < pages.length - 1) {
                    currentPage++;
                    updatePages();
                }
            });

            updatePages();
        });
    </script>
@endsection
