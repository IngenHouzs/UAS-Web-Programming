@extends('layouts.with-header-footer')

@section('landing-page')


    @auth
        @if (auth()->user()->role === 1)
            <h1>Selamat datang, {{auth()->user()->name}}, ADMIN NI BOSQ</h1>
        @else
            <h1>Selamat datang, {{auth()->user()->name}}, USER GW</h1>
        @endif
    @else 

    @endauth



@endsection