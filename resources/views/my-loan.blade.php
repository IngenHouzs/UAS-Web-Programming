@extends('layouts.with-header-footer')

@section('my-loan')

    <h1>Daftar Pinjamanku</h1>

    @foreach($loans as $loan)

        Judul : <p>{{$loan->judul}}</p> 
        <a href="/collection/{{$loan->id_buku}}"><button>Lihat detail buku</button></a>
        @if($loan->tanggal_peminjaman && $loan->tenggat_pengembalian)
            Tanggal Peminjaman : <p>{{$loan->tanggal_peminjaman}}</p> 
            Tenggat Pengembalian : <p>{{$loan->tenggat_pengembalian}}</p> 
        @else 
            Requested
            <form action="/deleteLoanRequest/{{$loan->id_peminjaman}}" method="POST">
                @csrf 
                <button type="submit">Batalkan Permintaan</button>
            </form>
        @endif
        <br>

    @endforeach


@endsection