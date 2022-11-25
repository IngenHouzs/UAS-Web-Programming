@extends('layouts.with-header-footer')

@section('landing-page')


    @auth
        @if (auth()->user()->role === 1)
            <h1>Selamat datang, {{auth()->user()->name}}, ADMIN NI BOSQ</h1>
        @else
            <h1>Selamat datang, {{auth()->user()->name}}, USER GW</h1>
        @endif
    @else 
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas autem ipsam iste quia odit, perferendis voluptates, et ipsa pariatur nesciunt harum possimus accusantium aut exercitationem distinctio qui. Illum, asperiores! Quisquam officia fuga quos dicta eos, doloribus modi maiores fugit pariatur voluptas, sapiente dolorum. At blanditiis, eligendi temporibus atque asperiores consequatur?</p>
    @endauth








@endsection