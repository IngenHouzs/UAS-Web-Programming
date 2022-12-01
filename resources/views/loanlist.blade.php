@extends('layouts.with-header-footer')


@section('loanlist')

<div class="flex flex-row">
    <h1>Daftar Pinjaman</h1>   
</div>
    
    @foreach($loans as $loan)
        <p>Nama Peminjam : {{$loan->nama}}</p>
        <p>NIS Peminjam : {{$loan->nis}}</p>
        <p>Judul Buku : {{$loan->judul}}</p>            
        <br/>          
    @endforeach


@endsection