@extends('layouts.with-header-footer')

@section('add-student')

    @if(session('STUDENT_CREATED'))
        <p>{{session('STUDENT_CREATED')}}</p>
    @endif

    <h1>Tambah Siswa</h1>


    <form action="/tambahsiswa" method="POST">
        @csrf

        <input type="text" name="nisn" placeholder="NISN"></input>
        <input type="text" name="name" placeholder="Nama Siswa"></input>
        <button type="submit">Tambahkan</button>
        
    </form>

@endsection