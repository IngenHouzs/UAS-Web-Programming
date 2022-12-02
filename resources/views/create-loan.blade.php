@extends('layouts.with-header-footer')


@section('create-loan')


        Cari NIS atau Nama Siswa
        
        <input type="text" id="ls-findstudent" value="">
        <button onclick="ls_findStudent()">Cari</button>


    <script src="/js/liveSearch.js"></script>    
@endsection