@extends('layouts.with-header-footer')

@section('view-book')


    @if(session('SELF_QUOTA_FULL'))
        <p>{{session('SELF_QUOTA_FULL')}}</p>
    @endif

    @if(session('DOUBLE_REQUEST'))
    <p>{{session('DOUBLE_REQUEST')}}</p>
@endif

    <div class="container my-5">
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-primary"><a href="/collection" style="color: white !important;">Kembali</a></button>   
            </div>
        </div>
        <div id="book-details-container" class="row my-3">
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
                                {{$author->nama_penulis}}
                            @endforeach 
                            </td>
                        </tr>
                        <tr>
                            <td>Penerbit</td>
                            <td>:</td>
                            <td>{{$book->publisher->nama_penerbit}}</td>
                        </tr>
                        <tr>
                            <td>Stok</td>
                            <td>:</td>
                            <td>{{$book->stok}}</td>
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
        <div class="row">
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
                    <button type="submit">Hapus Buku</button>        
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

    @if(session('LOAN_SUCCESS'))
        <p>{{session('LOAN_SUCCESS')}}</p>
    @endif


@endsection