@extends('layouts.main')

@section('landing-page')


    @auth
        @if (auth()->user()->role === 1)
            <h1>Selamat datang, {{auth()->user()->name}}, ADMIN NI BOSQ</h1>
        @else
            <h1>Selamat datang, {{auth()->user()->name}}, GUEST GW</h1>
        @endif
    @else 
        <h1 class="text-white bg-dark">Guest</h1>
    @endauth
        <p>Lorem ipsum dolor sit amet, consectetur=m perspiciatis labore blanditiis nulla ipsam.</p>    


@endsection