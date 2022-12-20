@extends('layouts.with-header-footer')

@section('landing-page')
    <div>

        @auth
            @if(auth()->user()->role == 2 && $late)
                <div class="container py-3 my-4 bg-danger shadow late-warning" style="position: absolute;margin:0 auto;left:0;right:0;z-index:3">
                    <p class="text-white">Anda memiliki buku yang sudah habis durasi peminjamannya. Segera kembalikan buku, atau tambah durasi peminjaman.</p>
                    <a href="/pinjamanku?filter=late"><button class="bg-white rounded px-2" style="color:red;font-weight:bold;max-width:40rem;">Periksa Daftar Pinjaman</button></a>
                    <button onclick="closeWarning()" class="bg-white" style="color:red;position:absolute;right:.5rem;top:.5rem;border-radius:50%;font-weight:bold;height:1rem;width:1rem;text-align:center;font-size:.7rem;">X</button>
                </div>          
            @endif
        @endauth


        <div class="w3-content w3-display-container">
            <img class="mySlides" src="/asset/carousel1.png" style="width:100%">
            <img class="mySlides" src="/asset/carousel2.jpg" style="width:100%">
            <!-- <img class="mySlides" src="/asset/test3.jpg" style="width:100%"> -->
            <div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle" style="width:100%">
                <div class="w3-left w3-hover-text-khaki" onclick="plusDivs(-1)">&#10094;</div>
                <div class="w3-right w3-hover-text-khaki" onclick="plusDivs(1)">&#10095;</div>
                <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(1)"></span>
                <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(2)"></span>
                <!-- <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(3)"></span> -->
            </div>
        </div>

        <div class="container my-5">
            <div class="row">
                <div class="col-sm">
                    <div class="row">
                        <h3>Tunas Mulia Montessori School Online Library</h3>
                    </div>
                    <div class="row">
                        <p>
                        Tunas Mulia Montessori School is a school located in Gading Serpong with a national plus education system and a place to encourage student's future.
                        </p>
                    </div>
                </div>
                <div class="home-content-col col-sm d-flex align-items-center justify-content-center">
                    @include('components.bookicon')
                    <h4>Go To <a id="book-list-link" href="/collection">Book List</a></h4>
                </div>
            </div>
        </div>
    </div>
@endsection