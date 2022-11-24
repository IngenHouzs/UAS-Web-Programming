@extends('layouts.with-header-footer')

@section('catalogue')

    <h1>Daftar Buku</h1>
    @foreach($books as $book)    
        <p>Judul -> {{$book->judul}}</p>
        <p>Penerbit -> {{$book->publisher->nama_penerbit}}</p>        
        <p>Author -> {{$book->author}}</p>
        <br/>
    @endforeach

@endsection