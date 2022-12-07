@extends('layouts.with-header-footer')

@section('landing-page')
    <div>
        <div class="w3-content w3-display-container">
            <img class="mySlides" src="/asset/test1.jpg" style="width:100%">
            <img class="mySlides" src="/asset/test2.jpg" style="width:100%">
            <img class="mySlides" src="/asset/test3.jpg" style="width:100%">
            <div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle" style="width:100%">
                <div class="w3-left w3-hover-text-khaki" onclick="plusDivs(-1)">&#10094;</div>
                <div class="w3-right w3-hover-text-khaki" onclick="plusDivs(1)">&#10095;</div>
                <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(1)"></span>
                <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(2)"></span>
                <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(3)"></span>
            </div>
        </div>

        <div class="container my-5">
            <div class="row">
                <div class="col-sm">
                    <div class="row">
                        <h3>Tunas Mulia Montessari School Online Library</h3>
                    </div>
                    <div class="row">
                        <p>
                            Tunas Mulia School adalah sekolah yang berada di gading serpong dengan sistem pendidikan nasional plus and a place to encourage student's future.
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