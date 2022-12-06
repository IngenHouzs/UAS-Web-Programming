@extends('layouts.with-header-footer')

@section('catalogue')
    <form action="/collection" method="GET">
        <div id="search-bar-container" class="container my-4 px-3 pt-2 pb-3">
            <div class="row">
                <div class="col">
                    <h5>Online Book Catalogues - Searching Tool</h5>
                </div>
            </div>
            <div class=" my-2">
                <div class="col">
                    <input class="mr-2" type="radio" name="query" value="judul" required>Judul</input>
                    <input class="mx-2" type="radio" name="query" value="penulis" required>Penulis</input>
                    <input class="mx-2" type="radio" name="query" value="penerbit" required>Penerbit</input>       
                </div>
            </div>
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
                <div class="col-6 my-2">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 id="book-title" class="card-title">{{$book->judul}}</h5>
                            <h6  id="book-details" class="card-subtitle my-2 text-muted">
                                @foreach($book->author as $author)
                                    <span id="book-author">{{$author->nama_penulis}}</span>
                                @endforeach
                                <span>|</span>
                                <span id="book-publisher">{{$book->publisher->nama_penerbit}}</span>
                            </h6>
      
                            <form action="/collection/{{$book->id}}" class="mt-auto">
                                <button class="w-100 btn btn-success ">View Details</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach            
            @endif 
            @endif
        </div>
    </div>


    <div class="container py-3 my-5">
        <a href="/addBook">Tambah Buku</a>
    </div>


@endsection