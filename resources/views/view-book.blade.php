@extends('layouts.with-header-footer')

@section('view-book')
    <div class="container mt-5">
        <div class="row">
            <div class="col">
            @if(session('SELF_QUOTA_FULL'))
                <p>{{session('SELF_QUOTA_FULL')}}</p>
            @endif
            
            @if(session('DOUBLE_REQUEST'))
                <div class="alert alert-danger" role="alert">
                    {{session('DOUBLE_REQUEST')}}
                </div>
            @endif

            @if(session('LOAN_SUCCESS'))
                <div class="alert alert-success" role="alert">
                    {{session('LOAN_SUCCESS')}}
                </div>
            @endif
            </div>
        </div>
    </div>

    <div class="container my-3">
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-warning"><a href="/collection">Kembali</a></button>   
            </div>
        </div>
        <div id="book-details-container" class="row my-2">
            <div class="col">
                <div class="jumbotron">
                    <h1 class="display-4">{{$book->judul}}</h1>
                    <hr class="my-4 hr-book">
                    <table id="book-details-table">
                        <tr>
                            <td>Karya</td>
                            <td>:</td>
                            <td>
                            @foreach($book->author as $author)
                                {{$author->nama_penulis}},
                            @endforeach 
                            </td>
                        </tr>
                        <tr>
                            <td>Penerbit</td>
                            <td>:</td>
                            <td>{{$book->publisher->nama_penerbit}}</td>
                        </tr>
                        <tr>
                            <td>Tahun Terbit</td>
                            <td>:</td>
                            <td>{{$book->tahun_terbit}}</td>
                        </tr>  
                        <tr>
                            <td>Tempat Terbit</td>
                            <td>:</td>
                            <td>{{$book->tempat_terbit}}</td>
                        </tr>                          
                        <tr>
                            <td>Halaman</td>
                            <td>:</td>
                            <td>{{$book->halaman}}</td>
                        </tr>                   
                        <tr>
                            <td>DDC</td>
                            <td>:</td>
                            <td>{{$book->ddc}}</td>
                        </tr>                      
                        <tr>
                            <td>ISBN</td>
                            <td>:</td>
                            <td>{{$book->isbn}}</td>
                        </tr>                       
                        <tr>
                            <td>No Rak</td>
                            <td>:</td>
                            <td>{{$book->no_rak}}</td>
                        </tr>                                        
                        <tr>
                            <td>Stok</td>
                            <td>:</td>
                            <td>{{$book->stok}}</td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>:</td>
                            <td>{{$book->keterangan}}</td>
                        </tr>                          
                       
                    </table>
                    <hr class="my-4 hr-book">
                    <table  id="book-status-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($loans as $loan)
                            <tr>
                                <td>Terpinjam</td>
                                @if ($loan->tenggat_pengembalian)
                                    <td>Sedang dipakai (Tenggat pengembalian : {{$loan->tenggat_pengembalian}} )</td>
                                @else
                                    <td>Dipesan</td>
                                @endif
                            </tr>
                        @endforeach
                        @for($ctr = 0; $ctr < $book->stok; $ctr++)
                            <tr>
                                <td>Tersedia</td>
                                <td>-</td>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col">
            @auth
                @if(auth()->user()->role === 2)
                    <form action="{{route('requestLoan', [$book->id, auth()->user()->id])}}" method="POST">
                        @csrf
                        @if(count($loans) >= $defaultStock)
                            <button type="submit" disabled style="btn btn-danger">Ajukan Peminjaman</button>   
                        @else
                            <button type="submit" class="btn btn-success">Ajukan Peminjaman</button>
                        @endif
                    </form>   
                @else 
                    <form action="/deleteBook/{{$book->id}}" method="POST">
                        @csrf
                        <button class="bg-danger text-white px-3 rounded" type="submit">Hapus Buku</button>                           
                    </form>
                @endif 
            @endauth
            @guest
                <form action="{{route('requestLoan', [$book->id, $book->id])}}" method="POST">
                    @csrf
                    @if(count($loans) >= $defaultStock)
                        <button type="submit" disabled style="btn btn-danger">Ajukan Peminjaman</button>            
                    @else
                        <button type="submit" class="btn btn-success">Ajukan Peminjaman</button>
                    @endif
                </form>       
            @endguest
            </div>
        </div>
    </div>
@endsection