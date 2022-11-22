@extends('layouts.main')
@section('forgot-password')

<div class="container">

    <div class="auth-card forgot-password-card mx-auto sm:w-full px-4">    

        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600 text-left">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status / ini teks -->
        <h1 class="text-sm">{{session('status')}}</h1>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="mx-auto flex-col">
                
                <label for="email"/>Email</label><br/>
                <input id="email" class="block mt-1 w-full inputs" type="email" name="email" required autofocus />
        
                <x-input-error :messages="$errors->get('email')" class="info-text"/>


                <br/>
                <button type="submit" class= "form-submit bg-primary text-white w-full">Send Password Reset Link</button>                              

            </div>
      

        </form>

                
        <br/>


    </div>
</div>

@endsection


 

