@extends('layouts.with-header-footer')

@section('catalogue')
    <form action="/collection" method="GET">
        <div id="search-bar-container" class="container my-4 px-3 pt-2 pb-3">
            <div class="row">
                <div class="col">
                    <h5>Online Book Catalogues - Searching Tool</h5>
                </div>
            </div>

            <input type="radio" name="query" value="judul" required>Judul</input>
            <input type="radio" name="query" value="penulis" required>Penulis</input>
            <input type="radio" name="query" value="penerbit" required>Penerbit</input>                 
            
            <div class="row">
                <div class="col">
                    <div class="wrap">
                        <div class="search">
                            <input type="text" class="searchTerm" name="string" placeholder="Search for Book Title, Author, or Publisher...">
                            <button type="submit" class="searchButton">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="search-dropdown-box"> --}}
                {{-- <div class="search-dropdown-content">
                    Hasil Pencarian 1
                </div>                                                 
                <div class="search-dropdown-content">
                    Hasil Pencarian 1
                </div>                                                             --}}
            {{-- </div>   --}}
        </div>
    </form>    
    

    <div id="catalogue-list-container" class="container py-3 my-5">
        <div class="row">
            <div class="col">
                <h4 class="text-white"><b>Daftar Buku</b></h4>
            </div>
        </div>
        <div class="row">
            @if ($books)
            @if (count($books) > 0)
                @foreach($books as $book)
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 id="book-title" class="card-title">{{$book->judul}}</h5>
                            <h6  id="book-details" class="card-subtitle my-2 text-muted">
                                @foreach($book->author as $author)
                                    <span id="book-author">{{$author->nama_penulis}}</span>
                                @endforeach
                                <span>|</span>
                                <span id="book-publisher">{{$book->publisher->nama_penerbit}}</span>
                            </h6>


                            <div id="action-button">
                                <a href="/collection/{{$book->id}}">
                                    <button class="btn btn-success">View Details</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach            
            @endif 
            @endif
        </div>
    </div>


    @auth 
        @if(auth()->user()->role === 1)
            <div class="container py-3 my-5">
                <a href="/collection/addBook"><button>Tambah Buku</button></a>
            </div>
        @endif
    @endauth




@endsection