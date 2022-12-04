@extends('layouts.with-header-footer')


@section('loanlist')

<div class="flex flex-row">
    <h1>Daftar Pinjaman</h1> 
    <form action="/loans" method="GET">
        <input type="text" placeholder="Masukkan Nama Siswa" name="nama"></input>
        <button type="submit">Search</button>
    </form>  

    <form action="{{route('createLoanView')}}" method="GET">
        <button type="submit">Tambah Pinjaman Baru</button>
    </form>


</div>
    
    @foreach($loans as $loan)
        <p>Nama Peminjam : {{$loan->nama}}</p>
        <p>NIS Peminjam : {{$loan->nis}}</p>
        <p>Judul Buku : {{$loan->judul}}</p>   
        <form action="/extendLoan/{{$loan->id_peminjaman}}" method="POST">
            @csrf
            <button type="submit">Tambah Durasi Pinjaman</button>
        </form>         

        <form action="/deleteLoan/{{$loan->id_peminjaman}}" method="POST">
            @csrf
            <button type="submit">Buku telah dikembalikan</button>
        </form>
        <br/>          
        <br/>
    @endforeach


@endsection