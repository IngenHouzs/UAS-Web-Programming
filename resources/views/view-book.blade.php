@extends('layouts.with-header-footer')

@section('view-book')

    <h1>{{$book->judul}}</h1>
    <h1>Penerbit : </h1>
    <p>{{$book->publisher->nama_penerbit}}</p>
    <h1>Authors :</h1>
    @foreach($book->author as $author)
        <p>{{$author->nama_penulis}}</p>
    @endforeach
    <form action="{{route('requestLoan', [$book->id, auth()->user()->id])}}" method="POST">
        @csrf
        <button type="submit">Ajukan Peminjaman</button>
    </form>

    @if(session('LOAN_SUCCESS'))
        <p>{{session('LOAN_SUCCESS')}}</p>
    @endif


@endsection