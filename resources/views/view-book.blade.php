@extends('layouts.with-header-footer')

@section('view-book')


    @if(session('SELF_QUOTA_FULL'))
        <p>{{session('SELF_QUOTA_FULL')}}</p>
    @endif

    @if(session('DOUBLE_REQUEST'))
    <p>{{session('DOUBLE_REQUEST')}}</p>
@endif


    <h1>{{$book->judul}}</h1>
    <h1>Penerbit : </h1>
    <p>{{$book->publisher->nama_penerbit}}</p>
    <h1>Authors :</h1>
 
    @foreach($book->author as $author)
        <p>{{$author->nama_penulis}}</p>
    @endforeach 
    
    <p>Stok Tersedia : {{$book->stok}}</p>

    <br>
    Status terpinjam
    <table>
        <tr>
          <th>Status</th>
          <th>Keterangan</th>
        </tr>

        @foreach($loans as $loan)
            <tr>
                <td>TERPINJAM</td>
                @if ($loan->tenggat_pengembalian)
                    <td>Sedang dipakai (Tenggat pengembalian : {{$loan->tenggat_pengembalian}} )</td>
                @else
                    <td>Dipesan</td>
                @endif
            </tr>
        @endforeach

        @for($ctr = 0; $ctr < $book->stok; $ctr++)
            <tr>
                <td>TERSEDIA</td>
                <td>-</td>
            </tr>
        @endfor
    </table>


    @auth
        @if(auth()->user()->role === 2)
            <form action="{{route('requestLoan', [$book->id, auth()->user()->id])}}" method="POST">
                @csrf
                @if(count($loans) >= $defaultStock)       
                     <button type="submit" disabled style="bg-red-500">Ajukan Peminjaman</button>            
                @else
                    <button type="submit">Ajukan Peminjaman</button>
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
                <button type="submit" disabled style="bg-red-500">Ajukan Peminjaman</button>            
            @else
                <button type="submit">Ajukan Peminjaman</button>
            @endif
        </form>       
    @endguest 

    @if(session('LOAN_SUCCESS'))
        <p>{{session('LOAN_SUCCESS')}}</p>
    @endif


@endsection