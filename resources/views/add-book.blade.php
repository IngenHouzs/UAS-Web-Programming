@extends('layouts.with-header-footer')


@section('add-book')

    <h1>Tambah Buku ke Katalog</h1>

    <form action="/collection/addBook" method="POST">
        @csrf
        <input type="text" name="judul" required>Judul</input>
        <br>
        <input type="text" name="penerbit" required>Penerbit</input>
        <br>
        <div class="author-box flex flex-column">
            <input type="text" name="penulis[]" required>Penulis</input>
        </div>
        <button type="button" onclick="addAuthor()">Tambah Penulis</button>
        <br>
        <input type="text" name="tahun_terbit" required>Tahun Terbit</input>
        <br>
        <input type="text" name="tempat_terbit" required>Tempat Terbit</input>        
        <br>
        <input type="text" name="halaman" required>Halaman</input>        
        <br>
        <input type="text" name="ddc" required>DDC</input>        
        <br>
        <input type="text" name="isbn" required>ISBN</input>        
        <br>
        <input type="text" name="no_rak" required>Rak</input>        
        <br>
        <input type="text" name="keterangan">Keterangan</input>       
        <br>

        <button type="submit">Buat Buku</button>
        

    </form>


@endsection