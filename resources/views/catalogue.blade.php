@extends('layouts.with-header-footer')

@section('catalogue')
    <div id="search-bar-container" class="container my-4 px-3 pt-2 pb-3">
        <div class="row">
            <div class="col">
                <h5>Online Book Catalogues - Searching Tool</h5>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="wrap">
                    <div class="search">
                        <input type="text" class="searchTerm" placeholder="Search for Book Title, Author, or Publisher...">
                        <button type="submit" class="searchButton">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="catalogue-list-container" class="container py-3 my-5">
        <div class="row">
            <div class="col">
                <h4 class="text-white"><b>Daftar Buku</b></h4>
            </div>
        </div>
        <div class="row">
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
        </div>
        
        
        <!-- <p>Judul -> {{$book->judul}}</p>
        <p>Penerbit -> {{$book->publisher->nama_penerbit}}</p>        

        <p><b>Author</b></p>
        @foreach($book->author as $author)
            <p>{{$author->nama_penulis}}</p>
        @endforeach

        <a href="/collection/{{$book->id}}"><button>View Detail</button></a>

        <br/> -->
        
    </div>
@endsection