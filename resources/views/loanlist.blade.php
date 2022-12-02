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
        <br/>          
    @endforeach


@endsection