@extends('layouts.with-header-footer')

@section('pending')


    @if(session('REQUEST_ACCEPTED'))
        <h1>{{session('REQUEST_ACCEPTED')}}</h1>
    @endif

    <div class="container my-4 px-3 pt-2 pb-3 flex flex-column pending-wrapper">
        <div class="daftar-pinjaman-header w-full">
            <h1>Daftar Permintaan Pending</h1>
        </div>        
        <div class="flex flex-row justify-content-center pending-search-siswa bg-white">
            <div class="half-color-parts"></div>
            <form action="/pending" method="GET">
                <input type="text" placeholder="Masukkan Nama Siswa" name="nama"></input>
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>  
        </div>
        <div class="pinjaman-pending-body bg-white">
            mwmw
        </div>
    </div>


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
        <form action="{{route('rejectLoan', [$request->id_peminjaman])}}" method="POST">
            @csrf 
            <button type="submit">Tolak</button>
        </form>
        <br/>            

    @endforeach



@endsection