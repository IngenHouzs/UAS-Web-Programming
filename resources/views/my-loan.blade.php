@extends('layouts.with-header-footer')

@section('my-loan')

    @if($hasLate)
        <div class="container py-3 my-4 bg-danger">
            <p class="text-white">Anda memiliki buku yang sudah habis durasi peminjamannya. Segera kembalikan buku, atau tambah durasi peminjaman.</p>
        </div>
    @endif

    <div id="catalogue-list-container" class="container py-3 my-4">
        <div class="row">
            <div class="col">
                @if (count($loans) > 0)
                    <div class="flex flex-row my-loan-header">
                        <h4>Daftar Pinjamanku</h4>   
                        <div>
                            <a href="/pinjamanku?filter=late"><button class="bg-primary text-white px-2 rounded">Terlambat</button></a>
                            <a href="/pinjamanku?filter=requested"><button class="bg-primary text-white px-2 rounded">Diajukan</button></a>
                            <a href="/pinjamanku?filter=ongoing"><button class="bg-primary text-white px-2 rounded">Berlangsung</button></a>                            
                        </div>
                    </div>
                @else 
                    <div class="flex flex-row my-loan-header">
                        @if($search)
                            <h4>Tidak ada hasil.</h4>
                        @else 
                            <h4>Belum ada pinjaman</h4>                            
                        @endif 
  
                        <div>
                            <a href="/pinjamanku?filter=late"><button class="bg-primary text-white px-2 rounded">Terlambat</button></a>
                            <a href="/pinjamanku?filter=requested"><button class="bg-primary text-white px-2 rounded">Diajukan</button></a>
                            <a href="/pinjamanku?filter=ongoing"><button class="bg-primary text-white px-2 rounded">Berlangsung</button></a>                            
                        </div>
                    </div>                
                                
                @endif 
            </div>
        </div>
        <div class="row">
            @foreach($loans as $loan)
                <div class="col-md-6 my-2">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column" style="@if($loan->late) background-color:#ffd2cf;border:1px solid red; @endif">
                            <h5 id="book-title" class="card-title">{{$loan->judul}}</h5>
                            @if($loan->tanggal_peminjaman && $loan->tenggat_pengembalian) 
                                @if($loan->late)
                                    <h6 style="color:red;font-weight:bold;">MASA PEMINJAMAN SUDAH HABIS.</h6>
                                @endif 
                                <h6  id="book-details" class="card-subtitle my-2 text-muted">
                                    Tanggal Peminjaman {{$loan->tanggal_peminjaman}} </h6>
                                <h6  id="book-details" class="card-subtitle my-2 text-muted">
                                    Tenggat Pengembalian {{$loan->tenggat_pengembalian}}
                                </h6>
                                <button class="btn btn-warning">
                                    <a href="/collection/{{$loan->id_buku}}">Lihat detail buku</a>
                                </button>
                            @else
                                <small class="mb-2">Requested</small>
                                    <div class="d-flex">
                                        <a href="/collection/{{$loan->id_buku}}"><button class="btn btn-warning mr-2">Lihat detail buku</button></a>
                                        <form action="/deleteLoanRequest/{{$loan->id_peminjaman}}" method="POST" class="mt-auto">
                                            @csrf
                                            <button class="btn btn-danger ">Batalkan Permintaan</button>
                                        </form>
                                    </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
<!-- 
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

    @endforeach -->


@endsection