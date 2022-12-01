@extends('layouts.with-header-footer')

@section('pending')


@if(session('REQUEST_ACCEPTED'))
    <h1>{{session('REQUEST_ACCEPTED')}}</h1>
@endif

<h1>Data Pinjaman</h1>
    
    @foreach($pendingRequests as $user)
        @foreach($user->book as $book)
            <p>Nama Peminjam : {{$user->name}}</p>
            <p>NIS Peminjam : {{$user->id}}</p>
            <p>Judul Buku : {{$book->judul}}</p> 
            <form action="{{route('acceptLoan', [$user->id, $book->id])}}" method="POST">   
                @csrf      
                <button type="submit">Terima</button>
            </form>
            <br/>
        @endforeach
    @endforeach

@endsection