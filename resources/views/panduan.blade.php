@extends('layouts.with-header-footer')
@section('panduan')
    @auth
        @if(auth()->user()->role == 2 && $late)
            <div class="container py-3 my-4 bg-danger shadow late-warning" style="position: absolute;margin:0 auto;left:0;right:0;z-index:3">
                <p class="text-white">Anda memiliki buku yang sudah habis durasi peminjamannya. Segera kembalikan buku, atau tambah durasi peminjaman.</p>
                <a href="/pinjamanku?filter=late"><button class="bg-white rounded px-2" style="color:red;font-weight:bold;max-width:40rem;">Periksa Daftar Pinjaman</button></a>
                <button onclick="closeWarning()" class="bg-white" style="color:red;position:absolute;right:.5rem;top:.5rem;border-radius:50%;font-weight:bold;height:1rem;width:1rem;text-align:center;font-size:.7rem;">X</button>
            </div>          
        @endif
    @endauth


    <div class="container">
        <div class="row mt-2 mb-5">
            <div class="col">
                <div class="jumbotron">
                    <h1 class="display-4" style="font-weight: bold;">Panduan Peminjaman Buku</h1>
                    <hr class="my-4 hr-book">
                    <ol style="font-weight: bold;">
                        <li>Pelajar dapat meminjam buku secara langsung dengan mengunjungi perpustakaan, ataupun melalui sistem pemesanan buku melalui aplikasi E-Library Tunas Mulia.</li>
                        <li>Pelajar harus memberikan identitas akun (NISN) pada saat mendaftarkan buku ke dalam daftar pinjaman oleh staff perpustakaan.</li>
                        <li>Satu buku dapat dipinjam selama tujuh hari. Pelajar diperbolehkan untuk mengajukan penambahan waktu peminjaman kepada staff perpustakaan.</li>
                        <li>Pelajar diperbolehkan untuk meminjam lebih dari satu buku yang sama.</li>
                        <li>Batas maksimal jumlah peminjaman dalam satu waktu adalah lima buku.</li>
                        <li>Pengajuan peminjaman melalui aplikasi E-Library hanya memperbolehkan siswa untuk melakukan satu permintaan pengajuan pada buku yang sama. Pengajuan berikutnya pada buku yang sama hanya dapat dilakukan apabila pengajuan sebelumnya sudah diterima ataupun dibatalkan.</li>
                        <li>Pelajar dapat melakukan pembatalan pengajuan peminjaman buku melalui menu Pinjamanku.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection