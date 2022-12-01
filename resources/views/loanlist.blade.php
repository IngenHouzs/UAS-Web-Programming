@extends('layouts.with-header-footer')


@section('loanlist')

    <h1>Data Pinjaman</h1>
    
    @foreach($users as $user)
        @foreach($user->book as $book)
            <p>Nama Peminjam : {{$user->name}}</p>
            <p>NIS Peminjam : {{$user->id}}</p>
            <p>Judul Buku : {{$book->judul}}</p>            
            <br/>
        @endforeach
    @endforeach


@endsection