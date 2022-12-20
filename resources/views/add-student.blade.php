@extends('layouts.with-header-footer')

@section('add-student')

    @if(session('STUDENT_CREATED'))
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div class="alert alert-success" role="alert">                  
                    <p>{{session('STUDENT_CREATED')}}</p>           
                </div>     
            </div>
        </div>
    </div>    
    @endif

    <div class="container my-4 flex flex-column">
        <div class="px-3 bg-success flex flex-row align-items-center daftar-siswa-header shadow">
            <h1 class="h4 text-white">Daftarkan Siswa</h1>
        </div>
        <div class="bg-white daftar-desc px-3 py-2 shadow">
            <form action="/tambahsiswa" method="POST">
                @csrf
                <p>NISN</p>
                <input type="text" name="nisn" required></input>
                <p>Nama Siswa</p>
                <input type="text" name="name" required></input>

                <button class="rounded bg-success text-white px-2" type="submit">Tambahkan</button>
                
            </form>
        
        </div>
    </div>



@endsection