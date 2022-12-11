@extends('layouts.with-header-footer')


@section('create-loan')

@if(session('UNAVAILABLE'))

        <div class="container mt-3 alert alert-danger" role="alert">
            {{session('UNAVAILABLE')}}
        </div>
        @endif

        @if(session('SELF_QUOTA_FULL'))
        <div class="container mt-3 alert alert-danger" role="alert">
            {{session('SELF_QUOTA_FULL')}}
        </div>
        @endif    

        <div class="container my-4 flex flex-column add-loan-div">
            <div class="w-100 px-3 bg-primary flex flex-row align-items-center profil-siswa-header shadow">
                <h1 class="h4 text-white">Buat Pinjaman Baru</h1>
            </div>
            <div class="bg-white w-100 px-3 py-4 profil-desc shadow">
                @if(session('FAIL'))
                    <p style="color:red;">{{session('FAIL')}}</p>
                @endif
                <form action="{{route('addLoan')}}" method="POST" id="add-loan">
                    @csrf
                    <p style="font-weight:bold;">Cari NIS atau Nama Siswa</p>
                    <input type="text" id="ls-findstudent" name="nama" value="" required>
                    <button type="button" onclick="ls_findStudent()"><i class="fa fa-search"></i></button><br/>                    
                    <div class="find-student-notif">
                        <h1 style="font-size:1.2rem" class="text-dark"></h1> <!-- Ini template wrapper kalo ga nemu pelajar (cek liveSearch.js) -->
                        <div class="dropdown-ls-student flex flex-column h-auto w-4"> <!-- Ini template buat daftar pelajar kl ketemu -->
                        </div>
                    </div>
        
                    <p style="font-weight:bold;">Cari Judul Buku</p>
                    <input type="text" id="ls-findbook" name="book" value="" required>
                    <button type="button" onclick="ls_findBook()"><i class="fa fa-search"></i></button><br/>        
                    <div class="find-book-notif">
                        <h1 style="font-size:1.2rem" class="text-dark"></h1>  <!-- Ini template kalo ga nemu buku -->
                                <!-- Ini template wrapper buat daftar buku kl ketemu -->
                        <div class="dropdown-ls-book flex flex-column h-auto w-4"> <!-- Ini template buat daftar pelajar kl ketemu -->
                        </div>            
                    </div>     
            
                    <button type="submit" class="bg-primary text-white px-2 rounded my-2">Tambah</button>              
                </form>     
            </div>
        </div>


  

      
        



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="/js/liveSearch.js"></script>    
@endsection