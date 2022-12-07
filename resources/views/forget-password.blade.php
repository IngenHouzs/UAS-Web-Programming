@extends('layouts.with-header-footer')

@section('forget-password')

    <div class="container my-4 flex flex-column">
        <div class="px-3 bg-warning flex flex-row align-items-center daftar-siswa-header shadow">
            <h1 class="h4">Ganti Kata Sandi</h1>
        </div>
        <div class="bg-white daftar-desc px-3 py-2 shadow">
            <form action="/forgetpassword" method="POST">
                @csrf
                <p>Kata sandi</p>
                <input type="password" name="password"  required>
                <p>Konfirmasi kata sandi</p>
                <input type="password" name="confirm_password" required>        
        
                <button class="bg-warning rounded px-3 change-pw-button" type="submit">Ganti Kata Sandi</button>
        
            </form>
        
        </div>
    </div>

    

@endsection