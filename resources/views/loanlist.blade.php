@extends('layouts.with-header-footer')


@section('loanlist')




<div class="container my-4 px-3 pt-2 pb-3 flex flex-column">
    <div class="daftar-pinjaman-header w-full bg-warning bg-gradient">
        <h1 class="text-center">Daftar Pinjaman</h1> 
        <div class="flex flex-row justify-content-center daftar-pinjaman-search">
            <form action="/loans" method="GET">
                <input type="text" placeholder="Masukkan Nama Siswa" name="nama"></input>
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>  
    
        </div>


        
    </div>

    <div class="daftar-pinjaman-body w-full h-auto bg-light bg-gradient">
     

            <form action="{{route('createLoanView')}}" method="GET">
                <button type="submit">Tambah Pinjaman Baru</button>
            </form>        



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

    </div>

 


</div>

@endsection