@extends('layouts.with-header-footer')

@section('pending')


    @if(session('REQUEST_ACCEPTED'))
        <h1>{{session('REQUEST_ACCEPTED')}}</h1>
    @endif

    <div class="flex-row">
        <h1>Daftar Permintaan Pinjaman</h1>    
    </div>

    @foreach($requests as $request)

        <p>Nama Peminjam : {{$request->nama}}</p>
        <p>NIS Peminjam : {{$request->nis}}</p>
        <p>Judul Buku : {{$request->judul}}</p> 
        <form action="{{route('acceptLoan', [$request->id_peminjaman, $request->nis, $request->book_id])}}" method="POST">   
            @csrf      
            <button type="submit">Terima</button>
        </form>
        <br/>            

    @endforeach



@endsection