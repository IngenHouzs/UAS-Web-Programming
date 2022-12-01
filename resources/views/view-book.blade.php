@extends('layouts.with-header-footer')

@section('view-book')

    <h1>{{$book->judul}}</h1>
    <h1>Penerbit : </h1>
    <p>{{$book->publisher->nama_penerbit}}</p>
    <h1>Authors :</h1>
    @foreach($book->author as $author)
        <p>{{$author->nama_penulis}}</p>
    @endforeach

    @auth
        @if(auth()->user()->role === 2)
            <form action="{{route('requestLoan', [$book->id, auth()->user()->id])}}" method="POST">
                @csrf
                <button type="submit">Ajukan Peminjaman</button>
            </form>   
        @else 
            <button type="submit">Hapus Buku</button>        
        @endif 
    @endauth

    @guest
        <form action="{{route('requestLoan', [$book->id, $book->id])}}" method="POST">
            @csrf
            <button type="submit">Ajukan Peminjaman</button>
        </form>       
    @endguest 

    @if(session('LOAN_SUCCESS'))
        <p>{{session('LOAN_SUCCESS')}}</p>
    @endif


@endsection