@extends('layouts.with-header-footer')


@section('edit-book')


<div class="container my-4 flex flex-column">
    <div class="px-3 bg-white flex flex-column align-items-start add-book-form-wrapper" style="height:auto;">
        <h1>Edit Buku</h1>
        <p><i>{{$book->judul}}</i></p>
    </div>    
    <div class="px-3 py-1 bg-white flex flex-column align-items-center add-book-form-wrapper shadow">

        <form action="/editbuku/{{$book->id}}" method="POST">
            @csrf
            <p>Rak</p>
            <input type="text" name="no_rak" value="{{$book->no_rak}}" required></input>        
            <br>

            <p>Keterangan</p>
            <input type="text" name="keterangan" value="{{$book->keterangan}}"></input>       
            <br>

            <p>Stok</p>
            <input type="number" name="stok" value="{{$book->stok}}" min="{{count($loans)}}"></input>              
    
            <button type="submit" class="bg-success text-white rounded px-3">Simpan Perubahan</button>
            
    
        </form>
                
    </div>                   
</div>



@endsection