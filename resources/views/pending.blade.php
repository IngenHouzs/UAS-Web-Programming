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

            @if (count($requests) > 0)
                @foreach($requests as $request)
                    <div class="bg-white shadow flex flex-column pending-card">
                        <h1 class="h3">{{$request->nama}}</h1>
                        <p class="text-muted">{{$request->nis}}</p>
                        <a href="/collection/{{$request->book_id}}" class="text-primary h5">{{$request->judul}}</a>                               

                        <div class="flex flex-row justify-content-start action-button-loanlist">
                            <form action="{{route('acceptLoan', [$request->id_peminjaman, $request->nis, $request->book_id])}}" method="POST">   
                                @csrf      
                                <button class="mr-2 bg-secondary text-white" type="submit">Terima</button>
                            </form>
                            <form action="{{route('rejectLoan', [$request->id_peminjaman])}}" method="POST">
                                @csrf 
                                <button class="mr-2 bg-success text-white" type="submit">Tolak</button>
                            </form>                        
                        </div>

            
                    </div>
            @endforeach            
            @else 
                @if($search) 
                    <p class="text-center font-weight-bold">Data tidak ditemukan.</p>                  
                @else 
                    <p class="text-center font-weight-bold">Belum ada pengajuan pinjaman saat ini.</p>                
                @endif                  
            @endif

    
        </div>
    </div>





@endsection