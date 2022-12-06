@extends('layouts.with-header-footer')


@section('students')

    <h1>Data Pelajar</h1> 

    <a href="/tambahsiswa"><button>Daftarkan Pelajar Baru</button></a>

    <form action="/datasiswa" method="GET">
        <input type="text" name="name">Cari Siswa</input>
        <button type="submit">Cari</button>
    </form>
    <table>
        <tr>
          <th>Company</th>
          <th>Contact</th>
        </tr>
   


    @foreach($students as $student)

        <tr>
            <td>{{$student->name}}</td>
            <td>{{$student->nisn}}</td>
            <td>
                <a href="/datasiswa/{{$student->nisn}}"><button>Lihat Detail</button></a>
            </td>
        </tr>

    @endforeach

    </table>

@endsection