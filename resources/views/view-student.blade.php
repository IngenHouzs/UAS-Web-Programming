@extends('layouts.with-header-footer')

@section('view-student')

    <div class="container my-4 flex flex-column">
        <div class="w-100 px-3 bg-primary flex flex-row align-items-center profil-siswa-header">
            <h1 class="h4 text-white">Profil Siswa</h1>
        </div>
        <div class="bg-white w-100 px-3 profil-desc">
            <h1>Nama</h1>
            <p>{{$student->name}}</p>
            <h1>NISN</h1>
            <p>{{$student->nisn}}</p>
        </div>
    </div>

    <div class="container my-4 flex flex-column">
        <div class="w-100 px-3 bg-primary flex flex-row align-items-center profil-siswa-header">        
            <h1 class="h4 text-white">Daftar Pinjaman</h1>
        </div>
        <div class="bg-white w-100 px-3 py-2 flex flex-column profil-descs">
            
            @if(count($loans) > 0) 
                @foreach($loans as $loan)
                    <div class="w-80 h-10 px-4 py-3 bg-white shadow flex flex-column loan-card">
                        @if($loan->tanggal_peminjaman && $loan->tenggat_pengembalian)
                            <div class="flex flex-column loan-desc">
                                <h1>Judul Buku</h1>
                                <a href="/collection/{{$loan->id_buku}}" class="text-primary">{{$loan->judul}}</a>
                            </div>
                            <div class="flex flex-column loan-desc">
                                <h1>Tanggal Peminjaman</h1>
                                <a>{{$loan->tanggal_peminjaman}}</a>
                            </div>
                            <div class="flex flex-column loan-desc">
                                <h1>Tenggat Pengembalian</h1>
                                <a>{{$loan->tenggat_pengembalian}}</a>
                            </div>                                                     
                        @else 
                            <div class="flex flex-column loan-desc">
                                <h1>Judul Buku</h1>
                                <a href="/collection/{{$loan->id_buku}}" class="text-primary">{{$loan->judul}}</a>
                            </div>
                            <form action="/acceptLoan/{{$loan->id_peminjaman}}/{{$student->nisn}}/{{$loan->id_buku}}" method="POST">
                                @csrf
                                <input type="text" hidden name="redirect" value="1">
                                <button type="submit" class="bg-primary text-white px-2 rounded">Terima Peminjaman</button>
                            </form>
                        @endif
                    </div>                 
                @endforeach            
            @else
                <p class="text-center font-weight-bold">Tidak ada aktivitas.</p>                
            @endif

    
        </div>        
    </div>    









@endsection