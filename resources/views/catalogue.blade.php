@extends('layouts.with-header-footer')

@section('catalogue')

    <h1>Daftar Buku</h1>
    @foreach($books as $book)    
        <p>{{$book->judul}}</p>
        <p>{{$book->publisher->nama_penerbit}}</p>        

    @endforeach

@endsection