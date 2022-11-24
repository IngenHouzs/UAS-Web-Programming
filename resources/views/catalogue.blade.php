@extends('layouts.with-header-footer')

@section('catalogue')

    <h1>Daftar Buku</h1>
    @foreach($books as $book)    
        <p>Judul -> {{$book->judul}}</p>
        <p>Penerbit -> {{$book->publisher->nama_penerbit}}</p>        

        <p><b>Author</b></p>
        @foreach($book->author as $author)
            <p>{{$author->nama_penulis}}</p>
        @endforeach
        <br/>
    @endforeach

@endsection