@extends('layouts.main')

@section('landing-page')

    @auth
        @if (auth()->user()->role === 1)
            <h1>Selamat datang, {{auth()->user()->name}}, ADMIN NI BOSQ</h1>
        @else
            <h1>Selamat datang, {{auth()->user()->name}}</h1>
        @endif
    @else 
        <h1>Guest</h1>
    @endauth

@endsection