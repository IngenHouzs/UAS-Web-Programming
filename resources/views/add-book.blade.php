@extends('layouts.with-header-footer')


@section('add-book')


    <div class="container my-4 flex flex-column">
        <div class="px-3 bg-white flex flex-row align-items-center add-book-form-wrapper">
            <h1>Tambah Buku</h1>
        </div>    
        <div class="px-3 py-1 bg-white flex flex-column align-items-center add-book-form-wrapper shadow">

            <form action="/collection/addBook" method="POST">
                @csrf
                <p>Judul<span class="required">*</span></p>
                <input type="text" name="judul" required></input>
                <br>

                <p>Penerbit<span class="required">*</span></p>                
                <input type="text" name="penerbit" required></input>
                <br>

                <div class="flex flex-row my-2">
                    <p>Penulis<span class="required">*</span></p>                   
                    <button class="bg-primary mx-3 text-white rounded px-3" type="button" onclick="addAuthor()">Tambah Penulis</button> 
                </div>
  
                <div class="author-box flex flex-column">
                    <input class="author-input" type="text" name="penulis[]" required></input>
                </div>
                <br>

                <p>Tahun Terbit<span class="required">*</span></p>   
                <input type="text" name="tahun_terbit" required></input>
                <br>

                <p>Tempat Terbit<span class="required">*</span></p>  
                <input type="text" name="tempat_terbit" required></input>        
                <br>

                <p>Halaman<span class="required">*</span></p> 
                <input type="text" name="halaman" required></input>        
                <br>

                <p>DDC<span class="required">*</span></p>                 
                <input type="text" name="ddc" required></input>        
                <br>

                <p>ISBN<span class="required">*</span></p> 
                <input type="text" name="isbn" required></input>        
                <br>

                <p>Rak<span class="required">*</span></p>
                <input type="text" name="no_rak" required></input>        
                <br>

                <p>Keterangan</p>
                <input type="text" name="keterangan"></input>       
                <br>
        
                <button type="submit" class="bg-success text-white rounded px-3">Buat Buku</button>
                
        
            </form>
                    
        </div>                   
    </div>



@endsection