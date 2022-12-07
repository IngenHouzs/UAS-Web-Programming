@extends('layouts.with-header-footer')


@section('students')




    <div class="my-4 px-3 pt-2 pb-3 flex flex-column">
        <div class="flex flex-row justify-content-between search-siswa-header">
            <h1 class="h2 font-weight-bold">Data Pelajar</h1>   
            <a href="/tambahsiswa"><button class="bg-primary text-white px-2 rounded">Daftarkan Pelajar Baru</button></a>
    
            <form action="/datasiswa" method="GET">
                <input type="text" name="name" class="search-siswa-input" placeholder="Cari siswa..."></input>
                <button type="submit" class="search-siswa-submit"><i class="fa fa-search"></i></button>
            </form>
        </div>

        
 
        <table class="table table-striped">
            <thead>
                <tr>
                  <th scope="col">Nama</th>
                  <th scope="col">NISN</th>
                  <th scope="col"></th>                
                </tr>
              </thead>
              <tbody>            
                    @foreach($students as $student)
                        <tr>
                            <td>{{$student->name}}</td>
                            <td>{{$student->nisn}}</td>
                            <td>
                                <a href="/datasiswa/{{$student->nisn}}"><button class="rounded bg-success text-white px-3">Lihat Detail</button></a>
                            </td>
                        </tr>
                    @endforeach
              </tbody>
    
        </table>              
    </div>    



@endsection