@extends('layouts.no-header-footer')

@section('verify-email')


        <div class="container flex justify-center items-center">
            <div class="auth-card verify-email-card flex-col items-center">

                <x-slot name="logo">
                    <a href="/">
                        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                    </a>
                </x-slot>

                <div class="mb-4 text-sm text-gray-600 flex-column">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </div>
                @endif


                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf         
                        <button class="resend-verification-button bg-primary text-white">
                            {{ __('Resend Verification Email') }}
                        </button>
                 
                </form>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="logout-verify-email underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 absolute">
                        {{ __('Log Out') }}
                    </button>
                </form>


    </div> 
</div>

@endsection