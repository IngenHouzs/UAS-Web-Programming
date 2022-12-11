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
     
        <div class="flex flex-row justify-content-between">
            <div onclick="filterDropdown()" class="filter-dropdown bg-primary text-white w-20">
                Filter
                <div class="dropdown-filter" style="display:none;">
                    <a href="/loans?filter=asc"><button>Terlama</button></a>
                    <a href="/loans?filter=desc"><button>Terbaru</button></a>
                    <a href="/loans?filter=late"><button>Terlambat</button></a>                                        
                    <a href="/loans?filter=ongoing"><button>Sedang Berjalan</button></a>                        
                </div>
            </div>    
            
            <form class="mb-3" action="{{route('createLoanView')}}" method="GET">
                <button class="bg-dark"type="submit">Tambah Pinjaman Baru</button>
            </form>       
        </div>
   
        @if(count($loans) > 0)

            @foreach($loans as $loan)
                <div class="w-80 h-10 px-4 @if(!$loan->late) bg-white @endif shadow flex flex-column loan-card" style="@if($loan->late) background-color:#ffd2cf @endif">
                    <div class="w-100 flex flex-row loan-inner-card">
                        <div class="w-50">
                            <h1 class="h3">{{$loan->nama}}</h1>
                            <p class="text-muted">{{$loan->nis}}</p>
                            <a href="/collection/{{$loan->id_buku}}" class="text-primary h5">{{$loan->judul}}</a>
                        </div>
                        <div class="w-50 flex flex-row justify-content-between pt-1 loan-date">
                            <div class="flex flex-column">
                                <h1 class="h5"><strong>Tanggal Peminjaman</strong></h1>
                                <p class="h6">{{$loan->tanggal_peminjaman}}</p>
                            </div>
                            <div class="flex flex-column">
                                <h1 class="h5"><strong>Tenggat Pengembalian</strong></h1>
                                <p class="h6">{{$loan->tenggat_pengembalian}}</p>
                            </div>
                        </div>                            
                    </div>
                    
                    <div class="flex flex-row justify-content-start action-button-loanlist">
                        <form action="/extendLoan/{{$loan->id_peminjaman}}" method="POST">
                            @csrf
                            <button class="mr-2 bg-secondary text-white" type="submit">Tambah Durasi Pinjaman</button>
                        </form>         
                        <form action="/deleteLoan/{{$loan->id_peminjaman}}" method="POST">
                            @csrf
                            <button class="mr-2 bg-success text-white" type="submit">Buku telah dikembalikan</button>
                        </form>  
                    </div>

                    
                </div>            
    
                <br/>          
                <br/>
            @endforeach   

        @else
                @if($search) 
                    <p class="text-center font-weight-bold">Data tidak ditemukan.</p>                  
                @else 
                    <p class="text-center font-weight-bold">Belum ada pinjaman saat ini.</p>                
                @endif 


        @endif

    </div>

 


</div>

@endsection