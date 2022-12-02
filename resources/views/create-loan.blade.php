@extends('layouts.with-header-footer')


@section('create-loan')

        <form action="{{route('addLoan')}}" method="POST" id="add-loan">
            @csrf
         
        Cari NIS atau Nama Siswa
            <input type="text" id="ls-findstudent" name="nama" value="">
            <button type="button" onclick="ls_findStudent()">Cari</button><br/>
            <div class="find-student-notif">
                <h1></h1> <!-- Ini template wrapper kalo ga nemu pelajar (cek liveSearch.js) -->
                <div class="dropdown-ls-student flex flex-column h-auto w-4"> <!-- Ini template buat daftar pelajar kl ketemu -->
                </div>
            </div>
    
    
            Cari Judul Buku
    
            <input type="text" id="ls-findbook" name="book" value="">
            <button type="button" onclick="ls_findBook()">Cari</button><br/>        
            <div class="find-book-notif">
                <h1></h1> <!-- Ini template kalo ga nemu buku -->
                        <!-- Ini template wrapper buat daftar buku kl ketemu -->
                <div class="dropdown-ls-book flex flex-column h-auto w-4"> <!-- Ini template buat daftar pelajar kl ketemu -->
                </div>            
            </div>     
    
            <button type="submit">Tambah</button>              
        </form>       

      
        



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="/js/liveSearch.js"></script>    
@endsection