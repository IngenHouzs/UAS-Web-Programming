@extends('layouts.with-header-footer')

@section('view-student')

    <h1>Nama : {{$student->name}}</h1>
    <h1>NISN : {{$student->nisn}}</h1>

    <br>
    <h1>Daftar Pinjaman</h1>

    @foreach($loans as $loan)

        @if($loan->tanggal_peminjaman && $loan->tenggat_pengembalian)
            <p>Judul Buku : {{$loan->judul}}</p>
            <p>Tanggal Peminjaman : {{$loan->tanggal_peminjaman}}</p>
            <p>Tenggat Pengembalian : {{$loan->tenggat_pengembalian}}</p>        
        @else 
            <p>Judul Buku : {{$loan->judul}}</p>
            <form action="/acceptLoan/{{$loan->id_peminjaman}}/{{$student->nisn}}/{{$loan->id_buku}}" method="POST">
                @csrf
                <input type="text" hidden name="redirect" value="1">
                <button type="submit">Terima Peminjaman</button>
            </form>
        @endif

        <br><br>
    @endforeach




@endsection